import requests
import re
from pyquery import PyQuery as pq
from pymongo import MongoClient

def get_content(url):
    response = requests.get(url)
    response.encoding = 'gb2312'
    html = response.text
    info_ele = pq(html).find('.info')
    pq(info_ele)('small').remove()
    time = pq(info_ele).text()
    time = ' '.join(time.split(' ')[0:2])
    content_html = pq(html).find('.ar_in_cont_3')
    pq(content_html)('.hidden-xs').remove()
    content_html = re.sub(r'[\n\t\xa0]+', '', pq(content_html).html())
    content_html = content_html.lstrip()
    content_html = content_html.rstrip()
    return content_html,time


def get_id_from_url(url):
    return url.split('/')[-1].split('.')[0]

client = MongoClient()
top_news_co = client['hepaipk']['top_news']
recommend_news_co = client['hepaipk']['recommend_news']

url = 'http://www.dzpk.com/news/yejie/list_1_1.html'
response = requests.get(url)
response.encoding = 'gb2312'
html = response.text
slidebar_contents = pq(html).find('.sidebar .right_content')
for slidebar_content in slidebar_contents:
    top_text = pq(slidebar_content).find('.top a').text()
    if top_text == '新闻排行榜':
        news = pq(slidebar_content).find('.news_ph li a')
        paiming = 1
        for new in news:
            url = pq(new).attr('href')
            title = pq(new).attr('title')
            content,time = get_content(url)
            news_id = get_id_from_url(url)
            hepaipk_news = {
                'paiming': paiming,
                'url': pq(new).attr('href'),
                '_id': news_id,
                'title': title,
                'content': content,
                'time' : time
            }
            paiming += 1
            top_news_co.update_one({'_id': news_id},{'$set' : hepaipk_news},True)

    elif top_text == '推荐新闻':
        news = pq(slidebar_content).find('.news_tj li a')
        for new in news:
            url = pq(new).attr('href')
            title = pq(new).attr('title')
            content,time = get_content(url)
            news_id = get_id_from_url(url)
            hepaipk_news = {
                '_id': news_id,
                'time': time,
                'content': content,
                'title': title,
                'url': pq(new).attr('href')
            }
            recommend_news_co.update_one({'_id': news_id},{'$set': hepaipk_news},True)
    else:
        pass
