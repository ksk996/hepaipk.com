new Vue({
    el: ".container",
    data() {
        return {
            'club_count_for_per_page': 12,
            'total_ranking': {
                'clubs': [],
                'page_index': 1,
                'page_indexes': [],
                'total_page': 1,
                'total_count': 1,

            },
            'pkpoker_ranking': {
                'clubs': [],
                'page_index': 1,
                'page_indexes': [],
                'total_page': 1,
                'total_count': 1,
            },
            'current_page_index_style': {
                'background': '#ff6500',
                'border': '1px solid #ff3300',
                'color': 'white'
            },
            'normal_page_index_style': {
                'border': '1px solid #ddd',
                'color': 'black',
            }
        }
    },
    methods: {
        viewClubDetail(type, club_name) {

        },
        getClubList(type, page) {
            let that = this;
            axios.get(`get_club_list.php?page=${page}&type=${type}`)
                .then((res) => {
                    if (type === 'total_ranking') {

                        let max_page_index = 1;
                        that.total_ranking.clubs = res.data.data.clubs;
                        that.total_ranking.total_page = res.data.data.total_page;
                        that.total_ranking.page_index = page;
                        that.total_ranking.total_count = res.data.data.total_count;
                        if (parseInt(page) < 5) {
                            max_page_index = Math.min(10, that.total_ranking.total_page);
                        } else {
                            max_page_index = Math.min(parseInt(page) + 4, that.total_ranking.total_page);
                        }
                        let min_page_index = Math.max(1, parseInt(page) - 4);
                        that.total_ranking.page_indexes = [];
                        for (let tmp = min_page_index; tmp <= max_page_index; tmp++) {
                            that.total_ranking.page_indexes.push(tmp);
                        }
                    } else {
                        let max_page_index = 1;
                        that.pkpoker_ranking.clubs = res.data.data.clubs;
                        that.pkpoker_ranking.total_page = res.data.data.total_page;
                        that.pkpoker_ranking.page_index = page;
                        that.pkpoker_ranking.total_count = res.data.data.total_count;
                        if (parseInt(page) < 5) {
                            max_page_index = Math.min(10, that.pkpoker_ranking.total_page);
                        } else {
                            max_page_index = Math.min(parseInt(page) + 4, that.pkpoker_ranking.total_page);
                        }
                        let min_page_index = Math.max(1, parseInt(page) - 4);
                        that.pkpoker_ranking.page_indexes = [];
                        for (let tmp = min_page_index; tmp <= max_page_index; tmp++) {
                            that.pkpoker_ranking.page_indexes.push(tmp);
                        }
                    }
                })
                .catch((err) => {
                    console.log(err);
                });

        },

    },
    created() {
        this.getClubList('total_ranking', 1);
        this.getClubList('pkpoker_ranking', 1);
    }
});
