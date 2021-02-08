<template>
    <div class="text-gray-200 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl text-yellow-500 font-bold">
                    User Information Settings
                </h1>
            </div>
        </div>
        <div class="flex justify-center">
             <div class="bg-gray-200 rounded-md">
                <div class="w-full flex">
                    <!-- left -->
                    <div class="w-1/2">
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >First Name</label>
                                <input v-model="form.first_name" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Email</label>
                                <input v-model="form.email" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='email'  required>
                            </div>
                        </div>
                    </div>
                    <!-- right -->
                    <div class="w-1/2">
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Last Name</label>
                                <input v-model="form.last_name" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Birth Date</label>
                                <input v-model="form.birth_date" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='date'  required>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Contact No</label>
                                <input v-model="form.mobile_no" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-2 mb-4">
                    <div class='w-full px-3 mb-1'>
                        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Short Description</label>
                        <input v-model="form.description" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                    </div>
                </div>
                <div class="personal w-full border-t border-gray-400 pt-4 my-auto">
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="saveUser" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default {
        data: () => ({
            isLoading: false,
            fullPage: true,
            form: {
                id: 0,
                first_name: '',
                last_name: '',
                mobile_no:'',
                email:'',
                password: '',
                description:'',
                birth_date:''
            },
        }),
        computed: {
            ...mapGetters({

            }),
        },
        methods: {
            clearForm() {
                this.form = {
                    id: 0,
                    first_name: '',
                    last_name: '',
                    mobile_no:'',
                    email:'',
                    description:'',
                    birth_date:'',
                }
            },
            async checkEmail() {
                const response = await axios.post(`/check-email`, {
                    id: this.form.id,
                    email: this.form.email,
                    is_edit: true
                })
                if(response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Email already Exist',
                    })
                    this.form.email = ''
                    return response.data
                }
            },
            checkFields() {
                var message = [];
                if(this.form.first_name == ''){message.push('First Name')}
                if(this.form.last_name == ''){message.push('Last Name')}
                if(this.form.mobile_no == ''){message.push('Contact No')}
                if(this.form.email == ''){message.push('Email')}
                if(this.form.birth_date == ''){message.push('Birthdate')}
                if(this.form.password == ''){message.push('Password')}
                if(this.form.retypePassword == ''){message.push('Re-Type Password')}
                this.messages = message;
                return
            },
            async saveUser () {
                var checkEmail = await this.checkEmail()
                if(checkEmail) {
                    return
                }
                await this.checkFields();
                if(this.messages.length > 0) {
                    var message = '';
                    for(var ctr = 0; ctr < this.messages.length; ctr++) {
                        message = message +'*'+ this.messages[ctr] + '  '
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...Please Fill The Following',
                        text: message,
                    })
                    return
                }
                if(this.form.password != this.form.retypePassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password not Matched!',
                    })
                    return
                }
                this.isLoading = true
                await this.$store.dispatch('user/updateUser', this.form)
                this.isLoading = false
            },
            async getInfo() {
                const response = await axios.get(`/user-detail`)
                console.log(response.data.data);
                this.form = response.data.data;
            }
        },
        created() {
            this.getInfo();
        }
    }
</script>