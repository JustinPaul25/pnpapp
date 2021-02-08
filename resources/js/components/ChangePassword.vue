<template>
    <div class="text-gray-200 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl text-yellow-500 font-bold">
                    Change Password
                </h1>
            </div>
        </div>
        <div class="flex justify-center mt-10">
             <div class="bg-gray-200 rounded-md w-1/3">
                <div class="flex items-center justify-between mt-2">
                    <div class='w-full px-3 mb-1'>
                        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Password</label>
                        <input v-model="form.password" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='password'  required>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <div class='w-full px-3 mb-1'>
                        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Re-Type Password</label>
                        <input v-model="form.retypePassword" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='password'  required>
                    </div>
                </div>
                <div class="personal w-full border-t border-gray-400 pt-4 my-auto">
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="updatePassword" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <span>Change Password</span>
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
                password:'',
                retypePassword:''
            },
        }),
        computed: {
            ...mapGetters({

            }),
        },
        methods: {
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
            async updatePassword () {
                if(this.form.password != this.form.retypePassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password not Matched!',
                    })
                    return
                }
                this.isLoading = true
                await this.$store.dispatch('user/updatePassword', this.form)
                this.isLoading = false
                this.form.password = ''
                this.form.retypePassword = ''
            },
            async getInfo() {
                const response = await axios.get(`/user-detail`)
                this.form.id = response.data.data.id;
            }
        },
        created() {
            this.getInfo();
        }
    }
</script>