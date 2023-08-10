<template>
<div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
 <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="$emit('close')">&times;</button>
        <h4 class="modal-title">Add {{Title}}</h4>
      </div>

      <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
         
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
        <button type="submit" class="btn btn-primary" >Save</button>
      </div>
      </form>
    </div>
 </div>
</div> 
</template>
<script>
 export default {
     props:["Apps","Title","URL_Segment"],
        data() {
            return {
              
            }
        },
         created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
           this.placeholder = "Search Data "+ this.Title;
        },

    }
</script>