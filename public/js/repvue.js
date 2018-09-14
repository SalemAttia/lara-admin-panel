new Vue({
    el:"#rep",
    data:{
        region_id:'',
        areas:[],
        lines:[],
        franchise_id:''
    },methods:{
        getbrick:function(){
            this.loading = true;
            this.$http.get('/api/v1/getbrick/'+this.region_id).then(function(response) {
                    this.areas = response.body;
                    this.loading = false;
                },
                function(){
                    //error if any eror happen in data base
                });
        },
        getline:function () {
            this.loading = true;
            this.$http.get('/api/v1/getfranchise/'+this.franchise_id).then(function(response) {
                    this.lines = response.body;
                    this.loading = false;
                },
                function(){
                    //error if any eror happen in data base
                });
        },
    },
    ready : function () {
        if(this.region_id != ''){

            this.getbrick();
        }

        if(this.franchise_id != ''){

            this.getline();
        }

    }
});