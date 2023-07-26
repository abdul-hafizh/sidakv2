<template>
<div>

<section class="content-header">
      <h1>
        Home
        <small>Dashboard </small>
      </h1>
      
    </section>

<div class="content">
<div class="clearfix"></div>



<div class="clearfix"></div>
<div class="box box-solid box-warning">
    <div class="box-body">
          
            
              Selamat Datang di Dashboard
             
             
             
           
    </div>
</div>
<div class="text-center">

</div>
</div>

</div>
</template>

<script>
   export default {
        props:["Apps"],
        data() {
            return {
               lists:{},
            }
        },
        
        created() {  
           document.title = this.Apps;
        },
         mounted() {
           //this.getData();
        },
        computed: {
           base_url() {
                return BASE_URL;
            }, 
             
        },
        components: {
          
        },
        methods: {
          
          getData(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/dashboard';    
            axios.get(listUrl).then((response) => {
                self.lists = response.data;
                
                
                
            }).catch((error) => {
                console.log(error);
                
            });
             
          },

        }
    }
   
</script>

