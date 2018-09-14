// disabled and able any filed

new Vue({
    el:"#tablefilteration",
    data:{
        loading: false,
        filed:'id',
        order:'asc',
        searchtext:'',
        data:[],
        url:url,
        rowid:0,
        Dcounter:1
    },
    compute:function () {

    },
    methods:{
        getdata:function(){
            this.loading = true;
            $('#firstbody').remove();
            this.data = [];

            this.$http.get('/api/v1/'+this.url+'/search/?order='+this.order+'&&filed='+this.filed+'&&searchtext='+this.searchtext).then(function(response) {
                    this.data = response.body.data;
                    this.loading = true;
                },
                function(){
                    this.data = [];
                });
        },
        DeleteRow:function(){

            this.$http.get('/api/v1/'+this.url+'/DeleteItem/?id='+this.rowid).then(function(response) {
                    this.searchtext = '';
                    this.getdata();
                },
                function(){
                    this.data = [];
                });
            $('#delete-form-modal2').modal('hide');
        },
        showModel:function (id) {
            this.rowid = id;
            $('#delete-form-modal2').modal('show');
        }
    },
    ready : function () {

    }
});

