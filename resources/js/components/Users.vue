<template>
    <div class="text-gray-200 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl text-yellow-500 font-bold">
                    App Users
                </h1>
            </div>
            <div class="flex items-center">
                <button v-show="role != 'view_only'" @click="addUserModal" class="focus:outline-none ml-auto bg-yellow-500 hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
                    <span>Add User</span>
                </button>
            </div>
        </div><div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b text-gray-900">
                        <th class="text-left fali-color p-3 px-5">Full Name</th>
                        <th class="text-left fali-color p-3 px-5">Role</th>
                        <th class="text-left fali-color p-3 px-5">Email</th>
                        <th class="text-left fali-color p-3 px-5">Rank</th>
                        <th></th>
                    </tr>
                    <tr v-show="user.id != userInfo.id" v-for="user in users.data" class="border-b hover:bg-yellow-200 bg-gray-100">
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b class="uppercase">{{ `${user.last_name}, ${user.first_name}` }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ user.role }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ user.email }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ user.rank }}</b>
                        </td>
                        <td class="p-3 px-5 flex justify-end">
                            <button @click="openEditModal(user)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                Edit
                            </button>
                            <button @click="confirmDelete(user.id)" type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <modal name="edit-form" draggable=".window-header" :height="'auto'" :width="'70%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Fill Up Form</p>
                <button class="ml-auto text-white focus:outline-none" @click="closeModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
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
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Register As</label>
                                <select v-model="form.role" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' required>
                                    <option value="Complainant">Complainant</option>
                                    <option value="Barangay Administrator">Barangay Administrator</option>
                                    <option value="Police Administrator">Police Administrator</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
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
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Contact No</label>
                                <input v-model="form.mobile_no" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1' v-show="form.role == 'Police Administrator'">
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Rank</label>
                                <select v-model="form.rank_id" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' required>
                                    <option v-for="rank in ranks" :value="rank.id">{{ rank.rank }}</option>
                                </select>
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
                            <span>{{isEdit ? 'Update' : 'Save'}} User</span>
                        </button>
                        <button v-else disabled class="focus:outline-none ml-auto fali-bg hover:bg-orange-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>Saving....</span>
                        </button>
                    </div>
                </div>
            </div>
        </modal>
        <modal name="form" draggable=".window-header" :height="'auto'" :width="'70%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Edit Form</p>
                <button class="ml-auto text-white focus:outline-none" @click="closeModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
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
                        <div v-show="!isEdit" class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Password</label>
                                <input v-model="form.password" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='password'  required>
                            </div>
                        </div>
                        <div v-show="!isEdit" class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Retype Password</label>
                                <input v-model="form.retypePassword" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='password'  required>
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
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Contact No</label>
                                <input v-model="form.mobile_no" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Register As</label>
                                <select v-model="form.role" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' required>
                                    <option value="Complainant">Complainant</option>
                                    <option value="Barangay Administrator">Barangay Administrator</option>
                                    <option value="Police Administrator">Police Administrator</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1' v-show="form.role == 'Police Administrator'">
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Rank</label>
                                <select v-model="form.rank_id" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' required>
                                    <option v-for="rank in ranks" :value="rank.id">{{ rank.rank }}</option>
                                </select>
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
                            <span>{{isEdit ? 'Update' : 'Save'}} User</span>
                        </button>
                        <button v-else disabled class="focus:outline-none ml-auto fali-bg hover:bg-orange-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>Saving....</span>
                        </button>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default {
        data: () => ({
            isLoading: false,
            fullPage: true,
            form: {
                id:'0',
                first_name: '',
                last_name: '',
                mobile_no:'',
                email:'',
                role: '',
                rank_id:'',
                password: '',
                description:'',
                retypePassword:''
            },
            search: '',
            role: '',
            sortBy: '',
            isEdit: false,
            userInfo: {},
        }),
        computed: {
            ...mapGetters({
                ranks: 'rank/ranks',
                users: 'user/users'
            }),
        },
        methods: {
            addUserModal() {
                this.isEdit = false
                // this.clearForm()
                this.openModal()
            },
            openModal() {
                this.isEdit = false;
                this.$modal.show('form')
            },
            openEditModal(user) {
                this.$modal.show('edit-form')
                this.form = {
                    id: user.id,
                    first_name: user.first_name,
                    last_name: user.last_name,
                    mobile_no: user.mobile_no,
                    email: user.email,
                    role: user.role,
                    rank_id: user.rank_id,
                    description: user.description,
                }
            },
            closeEditModal() {
                this.$modal.hide('edit-form')
            },
            closeModal() {
                this.$modal.hide('form')
            },
            editUserModal(user) {
                this.isEdit = true;
                this.openEditModal();
            },
            async checkEmail() {
                if(this.isEdit) {
                    const response = await axios.get(`/user-detail`)
                    this.userInfo = response.data.data;
                } else {

                }
            },
            async saveUser () {
                this.checkEmail()
                if(this.form.password != this.form.retypePassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password not Matched!',
                    })
                    return
                }
                this.isLoading = true
                if(this.isEdit) {
                    await this.$store.dispatch('user/updateUser', this.form)
                    if(Object.keys(this.errors).length == 0) {
                        this.getUsers();
                        this.closeModal();
                    }
                } else {
                    await this.$store.dispatch('user/saveUser', this.form)
                    // if(Object.keys(this.errors).length == 0) {
                    //     // this.getUsers();
                    //     this.closeModal();
                    // }
                }
                this.isLoading = false
            },
            async getRanks() {
                await this.$store.dispatch('rank/getRanks')
            },
            async getUsers(page = 1) {
                await this.$store.dispatch('user/getUsers', {
                    params: {
                        page: page,
                        search: this.search,
                        role: this.role
                    }
                })
            },
            async getInfo() {
                const response = await axios.get(`/user-detail`)
                this.userInfo = response.data.data;
            }
        },
        created() {
            this.getRanks();
            this.getUsers();
            this.getInfo();
        }
    }
</script>