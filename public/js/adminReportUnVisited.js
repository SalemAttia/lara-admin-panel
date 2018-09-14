new Vue({
    el:"#adminreport",
    data:{
        region_id:'all',
        area_id:'all',
        category:'all',
        month:'all',
        haveactivity:'all',
        hcps:[],
        areas:[],
        loading:true
    },methods:{
        gethcps:function(){
            this.loading = true;
            this.$http.get('/api/v1/gethcpsUnvisited/'+this.region_id+'/'+this.area_id+'/'+this.category+'/'+this.month+'/'+this.haveactivity).then(function(response) {
                    this.hcps = response.body;
                    this.loading = false;
                },
                function(){
                    //error if any eror happen in data base
                    alert('No Data');
                });
        },
        getbrick:function(){
            this.loading = true;
            this.$http.get('/api/v1/getbrick/'+this.region_id).then(function(response) {
                    this.areas = response.body;

                },
                function(){
                    //error if any eror happen in data base
                    alert('No Data');
                });
        },
        handler:function(){
            this.getbrick();
            this.gethcps();
        },
    },
    ready : function () {
        this.gethcps();
        if(this.region_id != 'all'){
            this.getbrick();
        }

    }
});