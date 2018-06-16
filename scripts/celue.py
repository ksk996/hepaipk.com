import requests
import re
from pyquery import PyQuery as pq
from pymongo import MongoClient

def get_content(url):
    response = requests.get(url)
    response.encoding = 'gb2312'
    html = response.text
    content_html = pq(html).find('.arin-txt').html()
    return content_html


def get_id_from_url(url):
    return url.split('/')[-1].split('.')[0]

client = MongoClient()
celue_co = client['hepaipk']['celue']

celve_special_subject = 'student'
url = 'http://xueyuan.dzpk.com/celue/'
response = requests.get(url)
response.encoding = 'gb2312'
html = response.text
articles = pq(html).find('.tactic-artone')
for article in articles:
    subject_item = pq(article).find('.tactic-art-tittle').find('a')
    subject_code = pq(subject_item).attr('href').split('/')[-2]
    subject_title = pq(subject_item).attr('title')
    if subject_code == 'soft':
        continue
    grade_texts = pq(article).find('.tactic-art-grade')
    for grade_text in grade_texts:
        grade = pq(grade_text).find('.gradet-tittle a').text()
        contents = pq(grade_text).find('.gradet-test li a')
        for content in contents:
            url = pq(content).attr('href')
            item = {
                'grade': grade,
                'subject_code': subject_code,
                'subject_title': subject_title,
                'text': pq(content).attr('title'),
                'url': pq(content).attr('href'),
                'content': get_content(url),
                '_id': get_id_from_url(url)
            }
            celue_co.update_one({'_id': item['_id']},{'$set': item},True)
    
    
    arttxts = pq(article).find('.tactic-arttxt li a')
    for arttxt in arttxts:
        url = pq(arttxt).attr('href')
        item = {
            'subject_code': subject_code,
            'subject_title': subject_title,
            'text': pq(arttxt).attr('title'),
            'url': pq(arttxt).attr('href'),
            'content': get_content(url),
            '_id': get_id_from_url(url)
        }
        celue_co.update_one({'_id': item['_id']},{'$set': item }, True)
