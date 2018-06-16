<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>河牌网</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/common.css">
	<style>
		#total_ranking, #pkpoker_ranking {
			width: 590px;
			border: 1px solid #ddd;
			height: 1502px;
			position: relative;
		}

		#total_ranking {
			margin-right: 20px;
		}

		.club-list {
			padding: 0px 18px 0 16px;

		}

		.club {
			padding: 30px 0 2px;
			display: flex;
			flex-direction: row;
			align-items: center;
			border-bottom: 1px dashed #ddd;
			position: relative;
		}

		.club img {
			width: 104px;
			height: 104px;
			margin-right: 3px;
		}

		.club .paiming {
			margin-right: 12px;
			border-radius: 50%;
			color: white;
			background: #ddd;
			width: 22px;
			height: 22px;

			text-align: center;
			line-height: 22px;
		}
		.club .more-info {
			background: -webkit-linear-gradient(#ab2832, #871c24);
			/* Safari 5.1 - 6.0 */
			background: -o-linear-gradient(#ab2832, #871c24);
			/* Opera 11.1 - 12.0 */
			background: -moz-linear-gradient(#ab2832, #871c24);
			/* Firefox 3.6 - 15 */
			background: linear-gradient(#ab2832, #871c24);
			padding: 10px 20px;
			color: white;
			position: absolute;
			right: 20px;
			bottom: 20px;
		}
		.club .more-info a {
			color: white;
		}
		.club p span {
			margin-bottom: 10px;
		}

		.club p {
			display: flex;
			flex-direction: column;
			font-size: 12px;
		}

		.club p .club-title {
			font-size: 14px;
			font-weight: 400;
		}

		.ranking_1 {
			background-color: #ff3300 !important;
		}

		.ranking_2 {
			background-color: #ff9900 !important;
		}

		.ranking_3 {
			background-color: #ffcc00 !important;
		}
		.page {
			text-align: center;
			bottom: 20px;
			position: absolute;
			width: 100%;
		}
		.page a {
			display: inline-block;
			width: 22px;
			margin-right: 4px;
		}
		.page a:hover{
			background: #ff6500;
			border: 1px solid #ff3300;
			color: white !important;
		}
		.page .first,.page .pre, .page .next, .page .last{
			border:1px solid #ddd;
			padding: 2px 5px;
		}
	</style>
</head>
<body>
<div class="container">
    <?php
    require_once 'common.php';
    ?>
	<div class="row" style="display: flex; flex-direction: row;">
		<div id="total_ranking">
			<div class="title">
				<span class="text">综合排名</span>
			</div>
			<div class="club-list">
				<div class="club" v-for="club in total_ranking.clubs">
					<span class="paiming"
						  v-bind:class="{'ranking_1': club.paiming == 1,'ranking_2': club.paiming ==2,'ranking_3': club.paiming ==3}">{{club.paiming}}</span>
					<img :src="club.qrcode_img" class="img-responsive">
					<p>
						<span class="club-title">{{club.title}}</span>
						<span>人数：{{club.num_of_people}}</span>
						<span>{{club.description}}</span>
					</p>
					<span class="more-info"><a v-bind:href="club.detail_page">更多详情</a></span>
				</div>
			</div>
			<div class="page" v-if="total_ranking.total_page > 1">
				<span class="first" v-on:click="getClubList('total_ranking','1')">首页</span>
				<span v-if="total_ranking.page_index > 1" v-on:click="getClubList('total_ranking',total_ranking.page_index-1)" class="pre">上一页</span>
				<span v-for="page_index in total_ranking.page_indexes">
					<a v-on:click="getClubList('total_ranking',page_index)" v-bind:style="current_page_index_style" v-if="page_index == total_ranking.page_index">{{page_index}}</a>
					<a v-on:click="getClubList('total_ranking',page_index)" v-bind:style="normal_page_index_style" v-else>{{page_index}}</a>
				</span>
				<span v-if="total_ranking.page_index < total_ranking.total_page" v-on:click="getClubList('total_ranking',total_ranking.page_index + 1)" class="next">下一页</span>
				<span class="last" v-on:click="getClubList('total_ranking',total_ranking.total_page)" v-if="total_ranking.page_index < total_ranking.total_page">末页</span>
				<span>共{{total_ranking.total_page}}页{{total_ranking.total_count}}条</span>
			</div>
		</div>
		<div id="pkpoker_ranking">
			<div class="title">
				<span class="text">PKpoker排名</span>
			</div>
			<div class="club-list">
				<div class="club" v-for="club in pkpoker_ranking.clubs">
					<span class="paiming"
						  v-bind:class="{'ranking_1': club.paiming == 1,'ranking_2': club.paiming ==2,'ranking_3': club.paiming ==3}">{{club.paiming}}</span>
					<img :src="club.qrcode_img" class="img-responsive">
					<p>
						<span class="club-title">{{club.title}}</span>
						<span>人数：{{club.num_of_people}}</span>
						<span>{{club.description}}</span>
					</p>
					<span class="more-info" v-on:click="viewClubDetail('top_ranking',club.title)">更多详情</span>
				</div>
			</div>
			<div class="page" v-if="pkpoker_ranking.total_page > 1">
				<span class="first" v-on:click="getClubList('pkpoker_ranking','1')">首页</span>
				<span v-if="pkpoker_ranking.page_index > 1" v-on:click="getClubList('pkpoker_ranking',pkpoker_ranking.page_index-1)" class="pre">上一页</span>
				<span v-for="page_index in pkpoker_ranking.page_indexes">
					<a v-on:click="getClubList('pkpoker_ranking',page_index)" v-bind:style="current_page_index_style" v-if="page_index == pkpoker_ranking.page_index">{{page_index}}</a>
					<a v-on:click="getClubList('pkpoker_ranking',page_index)" v-bind:style="normal_page_index_style" v-else>{{page_index}}</a>
				</span>
				<span v-if="pkpoker_ranking.page_index < pkpoker_ranking.total_page" v-on:click="getClubList('pkpoker_ranking',pkpoker_ranking.page_index + 1)" class="next">下一页</span>
				<span class="last" v-on:click="getClubList('pkpoker_ranking',pkpoker_ranking.total_page)" v-if="pkpoker_ranking.page_index < pkpoker_ranking.total_page">末页</span>
				<span>共{{pkpoker_ranking.total_page}}页{{pkpoker_ranking.total_count}}条</span>
			</div>

		</div>
	</div>
    <?php
    require_once 'footer.php';
    ?>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="//unpkg.com/axios/dist/axios.min.js"></script>
<script src="assets/js/club.js"></script>
</body>
</html>