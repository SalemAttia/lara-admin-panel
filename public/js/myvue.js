// disabled and able any filed

new Vue({
	el:"#pharmacy",
	data:{
        region_id:'',
		area_id:'',
        government_id:'',
        loading: false,
		clinics:[],
        checkedclinics:[],
        areas:[]
	},methods:{
        getclinics:function(){
            this.loading = true;
			this.$http.get('/api/v1/clinicsAll/'+this.area_id+'/'+this.region_id).then(function(response) {
				this.clinics = response.body;
                    this.loading = false;
			},
			function(){
			//error if any eror happen in data base
                this.clinics = [];
		});
		},
        getbrick:function(){

            this.$http.get('/api/v1/getbrick/'+this.region_id).then(function(response) {
                    this.areas = response.body;

                },
                function(){
                    //error if any eror happen in data base
                });
        },
        get:function(id){
            this.loading = false;

            this.$http.get('/api/v1/getclinicschecked/'+id).then(function(response) {
                    this.checkedclinics = response.body;
                    this.loading = false;
                },
                function(){
                    //error if any eror happen in data base

                });
        },
	},
    ready : function () {
	    if(this.area_id != ''){
            this.getclinics();
            if (this.region_id != ''){
                this.getbrick();
            }
        }


    }
});

