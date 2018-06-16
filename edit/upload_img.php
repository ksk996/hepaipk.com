<?php
error_reporting('E_ALL');
require_once '../modal.php';
function generateRCID()
{
    // From: http://codeaid.net/php/generate-a-random-guid
    if (function_exists('com_create_guid')) {
        return substr(com_create_guid(), 1, 36);
    } else {
        mt_srand((double)microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));

        $guid = substr($charid, 0, 8) .
            substr($charid, 8, 4) .
            substr($charid, 12, 4) .
            substr($charid, 16, 4) .
            substr($charid, 20, 12);

        return strtolower($guid);
    }
}

use Aws\S3\S3Client;

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'ap-northeast-2',
    'credentials' => array('key' => 'AKIAJL7HQ4RVRC76M4PQ',
        'secret' => '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
')

]);

$filename = iconv('UTF-8', 'GBK', $_FILES['file']['name']);

$key = $_POST['key'];
if ($filename) {
    move_uploaded_file($_FILES["file"]["tmp_name"],
        "../image/club/" . $filename);
}
$random_id = generateRCID();
$img_path = '../image/club/'.$filename;
$img_ext = pathinfo($img_path)['extension'];
try {
    $result = $s3->putObject([
        'Bucket' => 'hepaipkimg',
        'Key' => 'club/'.$random_id.'.'.$img_ext,
        'Body' => fopen($img_path, 'r'),
        'ACL' => 'public-read',
    ]);
    echo json_encode(['s3_img_link' => $result['ObjectURL'], 'code' => '0000']);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo json_encode(['code' => '2000', 'msg' => 'There was an error uploading the file']);
}
?>