<template>

    <div class="row">

        <div class="col-md-4">

            <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>

                <div class="card-body" style="height:447px;">

                    <div class="chat_list" v-for="user in users" :key="user.id">
                        <div class="chat_people" 
                            @click="message_conversion(user)" >

                            <div class="chat_img">

                                <img
                                    src="/storage/demo/user1.png"
                                    height="35px"
                                    style="border-radius:50%;"
                                    v-if="!user.profile_image" />

                                <img
                                    v-bind:src="'/storage/profile_image/' + user.profile_image"
                                    height="35px"
                                    style="border-radius:50%;"
                                    v-if="user.profile_image" />

                            </div>

                            <div class="chat_ib">
                                <a style="cursor:pointer;" @click="message_conversion(user)">
                                    <h5 class="ml-2 mt-1">
                                        {{ user.name }}
                                        <span></span>
                                    </h5>
                                    <span class="ml-2 mt-1 text-muted" style="font-size:13px;">{{ user.user_type }}</span>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card direct-chat direct-chat-primary">

                <div class="card-header" v-if="messageClass">
                    <h3 class="card-title">
                        {{ receiver_user.name }}
                        <span v-if="isTyping" class="pl-2">
                            <div class="a float-right" style="--n: 5">
                                <div class="dot" style="--i: 0"></div>
                                <div class="dot" style="--i: 1"></div>
                                <div class="dot" style="--i: 2"></div>
                                <div class="dot" style="--i: 3"></div>
                                <div class="dot" style="--i: 4"></div>
                            </div>
                        </span>
                    </h3>
                </div>

                <div class="card-body" style="height:385px; overflow-y:scroll" v-if="chat_list.length" v-chat-scroll="{smooth: true}">

                    <div class="direct-chat-messages h-25" v-for="message in chat_list" :key="message.index">

                        <!-- <div v-if="message.receiver_id == receiver_user.id"> -->


                        <div class="direct-chat-msg" v-if="message.user_id != auth_user.id">
                            <!-- <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-timestamp float-right">{{ message.created_at }}</span>
                            </div> -->

                            <img
                                src="/storage/demo/user1.png"
                                class="direct-chat-img"
                                v-if="!receiver_user.profile_image" />

                            <img
                                v-bind:src="'/storage/profile_image/' + receiver_user.profile_image"
                                class="direct-chat-img"
                                v-if="receiver_user.profile_image" />


                            <div class="direct-chat-text">
                                {{ message.message }}
                            </div>
                        </div>

                        <div class="direct-chat-msg right" v-else>
                            <!-- <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-timestamp float-left">{{ message.created_at }}</span>
                            </div> -->

                            <img
                                src="/storage/demo/user1.png"
                                class="direct-chat-img"
                                v-if="!auth_user.profile_image" />

                            <img
                                v-bind:src="'/storage/profile_image/' + auth_user.profile_image"
                                class="direct-chat-img"
                                v-if="auth_user.profile_image" />

                            <div class="direct-chat-text">
                                {{ message.message }}
                            </div>

                        </div>

                        <!-- </div> -->

                    </div>

                </div>

                <div class="card-footer" v-if="messageClass">

                    <div class="input-group">
                        <input type="text"
                                name="message"
                                placeholder="Type Message ..."
                                class="form-control input-message"
                                @keydown="sendTypingEvent"
                                @keyup.enter="sendMessage()"
                                v-model="newMessage" >

                        <span class="input-group-append">
                            <button type="button" class="btn btn-primary" @click="sendMessage()">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<style>
    .active_chat{
        background: #343A40;
        color: #fff;
    }
    .a {
        color: #ffffff;
        font-size: 8px;
        padding-top: 3px;
    }
    .dot {
        background: gray;
    }
    .dot, .dot:after {
        display: inline-block;
        width: 2em;
        height: 2em;
        border-radius: 50%;
        animation: a 1.5s calc(((var(--i) + var(--o, 0))/var(--n) - 1)*1.5s) infinite;
    }
    .dot:after {
        --o: 1;
        background: currentcolor;
        content: '';
    }
    @keyframes a {
        0%, 50% {
            transform: scale(0);
        }
    }

    .chat_ib h5 {
        font-size:20px;
        color:#464646;
        margin:0 0 8px 0;
    }

    .chat_ib h5 span {
        font-size:13px;
        float:right;
    }

    .chat_ib p {
        font-size:14px;
        color:#989898;
        margin:auto
    }

    .chat_img {
        float: left;
    }

    .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
    }

    .chat_people {
        overflow:hidden;
        clear:both;
    }

    .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 18px 16px 10px;
    }

    .inbox_chat {
        height: 550px;
        overflow-y: scroll;
    }

    .loader,.loader:before,.loader:after {
        border-radius: 50%;
        width: 2.5em;
        height: 2.5em;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation: load7 1.8s infinite ease-in-out;
        animation: load7 1.8s infinite ease-in-out;
    }
    .loader {
        color: #ffffff;
        font-size: 10px;
        margin: 80px auto;
        position: relative;
        text-indent: -9999em;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }
    .loader:before,.loader:after {
        content: '';
        position: absolute;
        top: 0;
    }

</style>

<script>
    export default {

        props:['user'],

        data() {
            return{
                auth_user:{},
                users:{},
                chat_list:[],
                receiver_user:{},
                newMessage:'',
                activeUser:false,
                messageClass:false,
                isTyping:false,
                userId:null,
                is_message_user_css_class:false
            }
        },

        created() {
            this.user_list();

            Echo.join('chat')
                .listen('MessageSent',(event) => {
                    if((event.message.receiver_id == this.auth_user.id) && (event.message.user_id == this.receiver_user.id)){
                        this.chat_list.push(event.message);
                    }
                })
                .listenForWhisper('typing', (res) => {

                    if((res.receiver_user.id == this.auth_user.id) && (res.auth_user.id == this.receiver_user.id)){
                        this.isTyping = true;

                        setTimeout(() => {
                            this.isTyping = false;
                        }, 5000);
                    }
                })
        },

        methods: {
            user_list() {
                axios.get('/admin/user/list')
                .then( res => {
                    this.users = res.data;
                })
            },

            message_conversion(user){

                this.newMessage = '';

                this.messageClass = true;
                axios.get('/admin/user/chat_list/' + this.user.id + '/' + user.id)
                .then( res => {
                    this.chat_list = res.data;
                    this.receiver_user = user;

                    if(user.id == this.receiver_user.id){
                        this.is_message_user_css_class = true;
                    }
                });
            },

            sendMessage() {

                if(this.newMessage != ''){

                    this.emptyMessageErrorClass = true;

                    this.chat_list.push({
                        user_id:this.user.id,
                        receiver_id:this.receiver_user.id,
                        message: this.newMessage
                    });

                    axios.post('/admin/user/send_messages', {
                        receiver_id:this.receiver_user.id,
                        message: this.newMessage
                    });

                    this.newMessage = '';
                }else{

                    Vue.$toast.open({
                        message: 'Please Enter The Message',
                        type: 'error',
                        position: 'top-right'
                    });
                }
            },

            sendTypingEvent(){
                Echo.join('chat')
                    .whisper('typing', {
                        auth_user:this.user,
                        receiver_user:this.receiver_user
                    });
            },

            auth_user_data() {
                axios.get('/admin/user/auth_user_data')
                .then( res => {
                    this.auth_user = res.data;
                })
            }
        },

        mounted() {
            this.auth_user_data();

            const params = new URLSearchParams(window.location.search)
            this.userId = params.get('user');

            if(this.userId != null){

                this.newMessage = '';

                this.messageClass = true;

                axios.get('/admin/user/chat_list/' + this.user.id + '/' + this.userId)
                .then( res => {
                    this.chat_list = res.data;
                });

                axios.get('/admin/user/get_receiver_user/' + this.userId)
                .then( res => { 
                    this.receiver_user = res.data
                });

            }
        }   
    }
</script>
