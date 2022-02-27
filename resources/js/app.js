/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Autocomplete from 'vuejs-auto-complete'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sendprivatemessage-component', require('./components/SendPrivateMessageComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    components: {
        Autocomplete
      },
    el: '#app',
    data(){
        return{
        messages: [],
        store : {title:'',body:''}
        }
    },
    created(){
        Echo.channel('message-notification')
            .listen('MessageNotification',(e)=>{
                this.messages.push({title:e.message.title,body:e.message.body,time:e.message.time});
                console.log('Message Here',this.messages);
            });
    },
    methods: {
        showAlert: () => {
            alert("I'm working on it, comming soon.. ");
          },
          submit : function(e){
            e.preventDefault();
            let formData = new FormData(this.$refs.form)
            axios({
                method: "post",
                url: "/send-make-event",
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
              })
                .then((res) => {
                   this.store = {title:'',body:''}
                })
                .catch((error) => {
                    // error.response.status Check status code
                }).finally(() => {
                    //Perform action in always
                });
          },
          UsermouseOver:(hover,elm)=>{
                console.log("this element hover: ",hover);
          },
          autoCompleteFormattedDisplay:function(result){
           
            return result.name;
          },
          selectFormattedData:function(result){
            var url='/chat-rooms/'+btoa(result.value);
            window.location.href=url;
          }
    }
});