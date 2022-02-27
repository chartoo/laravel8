<template>
    <div>
    <div class=" shadow-lg bg-white pb-2 vh-85 vh-scroll">
    <div class="border shadow-sm bg-light border-end p-3">
        <h3 class="header-user-middle"> <i class="fa-solid fa-circle-user fa-1x"></i> {{userName}}</h3>
    </div>
        <ul class="list-unstyled p-3">
            <li v-for="(message, index) in messages" :key="index" >
                <div class="message-section py-1" v-html="getMessageParse(message)">  </div>
            </li>
        </ul>
    </div>
    <form v-if="emptyChatHistory()" ref="form_send_message" method="post" class="bg-white pt-2" >
        <div class="row">
            <div class="col-md-1 text-end pt-1">
            <i class="fa-solid fa-circle-plus fa-2x text-primary"></i>
            </div>
            <div class="col-md-9 pr-2">
                <textarea name="message" id="" rows="1" class="form-control mb-2" v-model="send_message" placeholder="History is on"></textarea>
            </div>
            <div class="col-md-2 p-0">
                <button type="submit" class="btn btn-primary btn-sm px-3" v-on:click="btn_send_message">Send >> </button>
            </div>
        </div>
    </form>
    </div>
</template>
<script>
    export default {
        props: ['roomCode','currentId','userCode','userName','histories'],
        mounted() {
            console.log('Component mounted.',this.histories);
        },
        data(){
            return{
                send_message:'',
                messages:this.histories
            }
        },
        created(){
            Echo.private('sending-message-'+this.roomCode)
            .listen('ChatPrivateMessage',(e)=>{
                this.messages.push(JSON.stringify(e.histories));
            });
        },
        methods: {
             btn_send_message:function(e){
              e.preventDefault();
              let formData = new FormData(this.$refs.form_send_message)
            axios({
                method: "post",
                url: "/chat/"+this.userCode+'/'+this.roomCode,
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
              })
                .then((res) => {
                   this.send_message = '';
                })
                .catch((error) => {
                    // error.response.status Check status code
                }).finally(() => {
                    //Perform action in always
                });
          },
          getMessageParse(message){
              var history=JSON.parse(message);
              var me='<div class="me-message"><small><sub>'+history.message.time+'<sub></small><span class="">'+history.message.text+'</span></div>';
              var you='<div class="you-message"><span class="">'+history.message.text+'</span><small><sub>'+history.message.time+'<sub></small><div>';
              var messageBox=this.currentId==history.from?me:you;
              return messageBox;
          },
          emptyChatHistory:function(){
              console.log('RoomCode',this.roomCode);
              if(this.roomCode!=null) return true;
              else return false;
          }
        }
    }
</script>
