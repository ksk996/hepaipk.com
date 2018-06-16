<?php
require_once 'modal.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>河牌网</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/common.css">
	<script src="assets/js/jquery.min.js"></script>
	<style>
		.tactic-art {
			width: 1200px;
			display: flex;
			flex-direction: row;
		}

		.tactic-artone {
			width: 386px;
			display: inline-block;
			height: 400px;
			background: #f2f2f2;
			border: #dbdbdb 1px solid;
			margin-right: 21px;
			margin-top: 20px;
			padding-left: 10px;
			padding-right: 10px;
			padding-top: 10px
		}

		.tactic-art .tactic-artone:last-child {
			margin-right: 0;
		}

		.tactic-art .tactic-artone a {
		}

		.tactic-art-tittle {
			font-size: 16px;
			font-weight: bold
		}

		.tactic-art-tittle a {
			color: #2c2b2b;

		}

		.tactic-art-grade {
			padding-top: 10px;
			padding-bottom: 7px;
			border-bottom: solid #d8d8d8 1px
		}

		.gradet-tittle {
			color: #7b1c14;
			font-size: 14px
		}

		.gradet-tittle a {
			color: #7b1c14
		}

		.gradet-tittle a:hover {
			color: #e17f00
		}

		.gradet-tittle span {
			font-size: 12px
		}

		.gradet-test {
			margin-top: 5px
		}

		ul {
			padding: 0 !important;
			margin: 0 !important;
		}

		.gradet-test li {
			line-height: 17px;
			padding: 0 !important;
			margin: 0 !important;
			list-style: none;
		}

		.gradet-test li a {
			background: url(assets/images/ico_sc.gif) no-repeat;
			padding-left: 10px;
			color: #2c2b2b;
			font-size: 12px;
		}

		.tactichi-art-grade {
			padding-top: 10px;
			padding-bottom: 7px
		}

		.tactic-arttxt {
			margin-top: 7px
		}

		.tactic-arttxt li {
			line-height: 20px;
			height: 20px;
			overflow: hidden
		}

		.tactic-arttxt li a {
			color: #2c2b2b;
			padding-left: 10px;
			font-size: 12px;
			background: url(assets/images/ico_sc.gif) no-repeat;
		}

	</style>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?php
    require_once 'common.php';
    ?>
	<div class="tactic-art row">
		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/MTT/" title="多桌定时比赛(MTT)">多桌定时比赛(MTT)</a>
			</h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle">
					<a href="http://xueyuan.dzpk.com/celue/MTT/gaoji/"
					   target="_blank">高级</a>
				</div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0608-15396"
							   title="Nicky教你打德州扑克：技术贴，几首牌的讨论" target="_blank">Nicky教你打德州扑克：技术贴，</a></li>
						<li><a href="celue_detail.php?id=2012-0627-9281"
							   title="Nicky教你打德州扑克： MTT策略第3部分-前期" target="_blank">Nicky教你打德州扑克： MTT策略</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/MTT/zhongji/"
											  target="_blank">中级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0513-14778"
							   title="德州扑克策略–玩家应该如何操纵锦标赛的前期" target="_blank">德州扑克策略–玩家应该如何操纵</a></li>
						<li><a href="celue_detail.php?id=2011-0422-967" title="多桌锦标赛的危机管理"
							   target="_blank">多桌锦标赛的危机管理</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/MTT/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2014-0616-19769"
							   title="想要在锦标赛成绩更好？ 来看看这三招吧！" target="_blank">想要在锦标赛成绩更好？ 来看看</a></li>
						<li><a href="celue_detail.php?id=2011-0422-968" title="为什么锦标赛比现金赛更弱一点"
							   target="_blank">为什么锦标赛比现金赛更弱一点</a></li>

					</ul>
				</div>
			</div>
		</div>
		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/SNG/" title="即时锦标赛(SNG)">即时锦标赛(SNG)</a>
			</h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/SNG/gaoji/"
											  target="_blank">高级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0626-15813"
							   title="德州扑克策略：有时不妨开池溜进底池，一探究" target="_blank">德州扑克策略：有时不妨开池溜进</a></li>
						<li><a href="celue_detail.php?id=2013-0529-15136"
							   title="Bryan Pellegrino教你打德州扑克–单挑SNG问" target="_blank">Bryan Pellegrino教你打德州扑克</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/SNG/zhongji/"
											  target="_blank">中级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0710-16089"
							   title="德州扑克牌局解析：Tom Dwan 碰上 Phil Hellm" target="_blank">德州扑克牌局解析：Tom Dwan 碰</a></li>
						<li><a href="celue_detail.php?id=2013-0704-15977"
							   title="德州扑克牌局解析：Daniel Negreanu在比赛中" target="_blank">德州扑克牌局解析：Daniel Negre</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/SNG/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2014-0228-18497"
							   title="德州扑克牌局讨论：什么才是最佳的扑克打法" target="_blank">德州扑克牌局讨论：什么才是最佳</a></li>
						<li><a href="celue_detail.php?id=2013-0415-13787"
							   title="德州扑克策略–领先下注，然后找到自己的位置" target="_blank">德州扑克策略–领先下注，然后找</a></li>

					</ul>
				</div>
			</div>
		</div>
		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/nlbbs/"
											 title="无限大筹码策略(NL BSS)">无限大筹码策略(NL BSS)</a></h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/nlbbs/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2012-0428-8269" title="德州扑克起手牌备忘单"
							   target="_blank">德州扑克起手牌备忘单</a></li>
						<li><a href="celue_detail.php?id=2012-0428-8267" title="小球派扑克策略"
							   target="_blank">小球派扑克策略</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/nlbbs/gaoji/"
											  target="_blank">高级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0304-12969"
							   title="AA再加注，遭遇恐怖的四家争牌，跟还是弃？" target="_blank">AA再加注，遭遇恐怖的四家争牌，</a></li>
						<li><a href="celue_detail.php?id=2012-1126-11620"
							   title="1000NL深筹码抡来抡去，都不开牌，好像全都在" target="_blank">1000NL深筹码抡来抡去，都不开牌</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/nlbbs/zhongji/" target="_blank">中级</a>
				</div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2011-0422-996"
							   title="德州扑克翻牌圈的下注策略" target="_blank">德州扑克翻牌圈的下注策略</a></li>
						<li><a href="celue_detail.php?id=2011-0422-995" title="德州扑克的位置"
							   target="_blank">德州扑克的位置</a></li>

					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="tactic-art row">

		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/Omaha/" title="奥马哈(Omaha)">奥马哈(Omaha)</a>
			</h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/Omaha/zhongji/" target="_blank">中级</a>
				</div>
				<div class="gradet-test">
					<ul>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/Omaha/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0329-13526"
							   title="奥马哈扑克与德州扑克的异同" target="_blank">奥马哈扑克与德州扑克的异同</a></li>
						<li><a href="celue_detail.php?id=2013-0327-13488" title="奥马哈扑克的基本策略"
							   target="_blank">奥马哈扑克的基本策略</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/Omaha/gaoji/"
											  target="_blank">高级</a></div>
				<div class="gradet-test">
					<ul>

					</ul>
				</div>
			</div>
		</div>
		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/suoha/"
											 title="七张牌梭哈高/低(7-Card Stud Hi/Lo)">七张牌梭哈高/低(7-Card Stud Hi/Lo)</a></h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/suoha/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/suoha/zhongji/" target="_blank">中级</a>
				</div>
				<div class="gradet-test">
					<ul>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/suoha/gaoji/"
											  target="_blank">高级</a></div>
				<div class="gradet-test">
					<ul>

					</ul>
				</div>
			</div>
		</div>
		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/linepoker/"
											 title="线下扑克">线下扑克</a></h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/linepoker/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-0925-17211"
							   title="德州扑克玩家须知：扑克锦标赛指导协会TDA新" target="_blank">德州扑克玩家须知：扑克锦标赛指</a></li>
						<li><a href="celue_detail.php?id=2013-0925-17210"
							   title="德州扑克玩家打牌时手部泄露的信息比脸多" target="_blank">德州扑克玩家打牌时手部泄露的信</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/linepoker/zhongji/"
											  target="_blank">中级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2014-0415-19163"
							   title="德州扑克现场锦标赛策略：进了钱圈 别大意！" target="_blank">德州扑克现场锦标赛策略：进了钱</a></li>
						<li><a href="celue_detail.php?id=2013-1123-17774"
							   title="德州扑克小锦囊：注意摇头后加注的马脚" target="_blank">德州扑克小锦囊：注意摇头后加注</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/linepoker/gaoji/"
											  target="_blank">高级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2015-0116-21258"
							   title="贴士：制定玩牌目标时应规避的五种常见错误" target="_blank">贴士：制定玩牌目标时应规避的五</a></li>
						<li><a href="celue_detail.php?id=2013-0828-16865"
							   title="职业选手对大型扑克锦标赛问题的一些解答" target="_blank">职业选手对大型扑克锦标赛问题的</a></li>

					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="tactic-art row">

		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/Psychology/"
											 title="扑克心理学&amp;扑克教学理论">扑克心理学&amp;扑克教学理论</a></h1>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/Psychology/chuji/"
											  target="_blank">初级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2014-0711-19954"
							   title="在德州扑克游戏中 你应该如何选择买入的范围" target="_blank">在德州扑克游戏中 你应该如何选</a></li>
						<li><a href="celue_detail.php?id=2014-0616-19768"
							   title="如何正确读人以及使用德州扑克游戏策略" target="_blank">如何正确读人以及使用德州扑克游</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/Psychology/chuji/"
											  target="_blank">中级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2013-1115-17706"
							   title="Ed Miller教你打扑克：如何在休息后恢复打牌" target="_blank">Ed Miller教你打扑克：如何在休</a></li>
						<li><a href="celue_detail.php?id=2013-1021-17474"
							   title="德州扑克策略：有好牌时应避免过分慢打" target="_blank">德州扑克策略：有好牌时应避免过</a></li>

					</ul>
				</div>
			</div>
			<div class="tactic-art-grade">
				<div class="gradet-tittle"><a href="http://xueyuan.dzpk.com/celue/Psychology/gaoji/"
											  target="_blank">高级</a></div>
				<div class="gradet-test">
					<ul>
						<li><a href="celue_detail.php?id=2014-0806-20161"
							   title="GTO（传说中最优游戏策略）之---基础篇" target="_blank">GTO（传说中最优游戏策略）之---</a></li>
						<li><a href="celue_detail.php?id=2014-0104-18048"
							   title="德州扑克策略推荐：怎样玩同花听牌" target="_blank">德州扑克策略推荐：怎样玩同花听</a></li>

					</ul>
				</div>
			</div>
		</div>

		<div class="tactic-artone">
			<h1 class="tactic-art-tittle"><a href="http://www.dzpk.com/poker_xueyuan/celue/student/" title="新手入门"
											 target="_blank">新手入门</a></h1>
			<div class="tactic-arttxt">
				<ul>
                    <?php
                    $tutorials = $celue_co->find(['subject_code' => 'student'], ['typeMap' => $typeMap]);
                    foreach ($tutorials as $tutorial) {
                        $id = $tutorial['_id'];
                        $title = $tutorial['title'];
                        echo <<< EOF
<li><a href="celue_detail.php?id=$id"
						   title="线上扑克手牌数据包：让您更全面的剖析对手" target="_blank">$title</a></li>
EOF;

                    }
                    ?>

				</ul>
			</div>

		</div>
	</div>
</div>
<?php
require_once 'footer.php';
?>
</div>
</body>
</html>