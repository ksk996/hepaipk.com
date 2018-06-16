$(document).ready(function () {
    var upload_imgs = {'logo': null, 'qrcode_img': null, 'intro_imgs': []};


    var current_type = 'total_ranking';
    $('body')
        .on('click', '.select-paiming', function () {
            let $this = $(this);
            $(`#${current_type}`).removeClass('active');
            $this.addClass('active');
            current_type = $this.attr('id');
        })
        .on('click', '#search', function () {
            let q = $("#search-item").val();
            var $myModal = $("#myModal");
            $myModal.modal('show');
            $('.modal-dialog').draggable();
            $("#modelRecommendPoi").empty();

            let url = `search.php?q=${q}&type=${current_type}`;
            $.getJSON(url, function (result) {
                $.each(result.data, function (i, v) {
                    $("#modelRecommendPoi").append('<option  ' +
                        ' data-more_info="' + v.more_info +
                        '" data-contact="' + v.contact +
                        '" data-logo="' + v.logo +
                        '" data-intro_imgs="' + v.intro_imgs +
                        '" data-num_of_people="' + v.num_of_people +
                        '" data-description="' + v.description +
                        '" data-qrcode_img="' + v.qrcode_img +
                        '" data-paiming="' + v.paiming +
                        '" data-title="' + v.title +
                        '" data-id="' + v._id +
                        '">' + v.title + '-' + v.paiming + '</option>');
                });
            });
        })
        .on('click', '#save', function () {
            let data = {
                'id': $("#id").val(),
                'title': $("#search-item").val(),
                'description': $("#description").val(),
                'paiming': $("#paiming").val(),
                'contact': $("#contact").val(),
                'num_of_people': $("#num_of_people").val(),
                'more_info': $("#more_info").val(),
                'logo': upload_imgs['logo'],
                'qrcode_img': upload_imgs['qrcode_img'],
                'intro_imgs': upload_imgs['intro_imgs'],
                'current_type': current_type,
            };
            $.post('save.php', data, function (data) {
                alert("保存成功");
                location.reload();
            })
        })
        .on('click', '.del_img', function () {
            let current_link = $(this).prev().attr('src');
            let img_container_id = $(this).parent().parent().next().attr('id').replace('upload-', '');
            console.log(img_container_id);
            if (img_container_id === 'logo' || img_container_id === 'qrcode_img') {
                upload_imgs[img_container_id] = null;
            } else {
                upload_imgs[img_container_id] = upload_imgs[img_container_id].filter(function (e) {
                    return e !== current_link
                })
            }
            $(this).parent().remove();
            console.log(upload_imgs);
        })
    ;

    $("#modelRecommendPoi").change(function () {
        let club_id = $(this).find(':selected').data('id');
        $(".del_club").css('visibility', 'visible').confirm({
            title: "",
            content: "确定要删除？",
            confirmButton: "确定",
            cancelButton: "取消",
            confirm: function () {
                $.getJSON(`delete_club.php?id=${club_id}&type=${current_type}`, function (result) {
                    console.log(result.code);
                    if (result.code === '0000') {
                        $('#modelRecommendPoi option').filter('[data-id="' + club_id + '"]').remove();
                        alert("删除成功");
                    } else {
                        alert("删除失败，请重新尝试");
                    }
                })

            }

        });
        $("#id").val($(this).find(':selected').data('id'));

        $("#search-item").val($(this).find(':selected').data('title'));
        $("#paiming").val($(this).find(':selected').data('paiming'));
        $("#description").val($(this).find(':selected').data('description'));
        $("#contact").val($(this).find(':selected').data('contact'));
        $("#more_info").val($(this).find(':selected').data('more_info'));
        $("#num_of_people").val($(this).find(':selected').data('num_of_people'));
        let logo = $(this).find(':selected').data('logo');
        if (logo) {
            upload_imgs['logo'] = logo;
            $("#show-logo").empty().append("<div><img src='" + logo + "' class='img-responsive'><button class='del_img btn-xs btn btn-danger'>删除</button></div>");
        }
        let qrcode_img = $(this).find(':selected').data('qrcode_img');
        if (qrcode_img) {

            upload_imgs['qrcode_img'] = qrcode_img;
            $("#show-qrcode_img").empty().append("<div><img src='" + qrcode_img + "' class='img-responsive'><button class='del_img btn-xs btn btn-danger'>删除</button></div>");
        }
        let intro_imgs = $(this).find(':selected').data('intro_imgs').split(',');
        upload_imgs['intro_imgs'] = intro_imgs;
        $("#show-intro_imgs").empty();
        $.each(intro_imgs, function (i, link) {
            $("#show-intro_imgs").append("<div><img src='" + link + "' class='img-responsive'><button class='del_img btn-xs btn btn-danger'>删除</button></div>")
        })
    });
    $.each(['logo', 'qrcode_img', 'intro_imgs'], function (index, item) {
        let multi;
        if (item === 'logo' || item === 'qrcode_img') {
            multi = false;
        } else {
            multi = true;
        }
        var up = $(`#upload-${item}`).Huploadify({
            auto: false,
            fileTypeExts: '*.*',
            multi: multi,
            formData: {key: item},
            fileSizeLimit: 99999999999,
            showUploadedPercent: true,
            showUploadedSize: true,
            removeTimeout: 9999999,
            uploader: 'upload_img.php',
            onUploadStart: function (file) {
                console.log(file.name + '开始上传');
            },
            onInit: function (obj) {
                console.log('初始化');
                console.log(obj);
            },
            onUploadComplete: function (file, result) {
                console.log(file.name + '上传完成');
                let object_result = $.parseJSON(result);
                if (object_result['code'] !== '0000') {
                    alert("上传图片失败");
                    return;
                }
                alert("上传成功");
                let img_link = object_result['s3_img_link'];
                if (item === 'logo' || item === 'qrcode_img') {
                    upload_imgs[item] = img_link;
                    $(`#show-${item}`).empty().append("<div><img src='" + img_link + "' class='img-responsive'><button class='del_img btn-xs btn btn-danger'>删除</button></div>");
                } else if (item === 'intro_imgs') {
                    upload_imgs[item].push(img_link);
                    $(`#show-${item}`).append("<div><img src='" + img_link + "' class='img-responsive'><button class='del_img btn-xs btn btn-danger'>删除</button></div>")
                }
                console.log(upload_imgs);
            },
            onCancel: function (file) {
                console.log(file.name + '删除成功');
            },
            onClearQueue: function (queueItemCount) {
                console.log('有' + queueItemCount + '个文件被删除了');
            },
            onDestroy: function () {
                console.log('destroyed!');
            },
            onSelect: function (file) {
                if ((item === 'logo' && upload_imgs['logo']) || (item === 'qrcode_img' && upload_imgs['qrcode_img'])) {
                    alert('仅限一张图片，重复上传会覆盖之前存在的照片');
                    return;
                }
                console.log(file.name + '加入上传队列');
            },
            onQueueComplete: function (queueData) {
                console.log('队列中的文件全部上传完成', queueData);
            }
        });
    });

});