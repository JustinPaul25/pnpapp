<template>
    <div class="text-gray-200 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl text-yellow-500 font-bold">
                    Crime Reports
                </h1>
            </div>
            <div class="flex items-center">
                <button v-show="role != 'view_only'" @click="openFormModal" class="focus:outline-none ml-auto bg-yellow-500 hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
                    <span>Add Crime Report</span>
                </button>
            </div>
        </div>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b text-gray-900">
                        <th class="text-left fali-color p-3 px-5">Date Reported</th>
                        <th class="text-left fali-color p-3 px-5">Person Name/ Item Name</th>
                        <th class="text-left fali-color p-3 px-5">Type</th>
                        <th class="text-left fali-color p-3 px-5">Media</th>
                        <th class="text-left fali-color p-3 px-5"></th>
                    </tr>
                    <tr v-for="report in reports.data" class="border-b hover:bg-yellow-200 bg-gray-100">
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ report.crime_date }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b class="uppercase">{{ report.name }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ report.crime.type }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <img width="5%" :src="report.image_url" alt="">
                        </td>
                        <td>

                        </td>
                        <!-- <td class="p-3 px-5 flex justify-end">
                            <button @click="openEditModal(user)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                Edit
                            </button>
                            <button @click="confirmDelete(user.id)" type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                Delete
                            </button>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
        <modal name="form" draggable=".window-header" :height="'600px'" :width="'80%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Report Form</p>
                <button class="ml-auto text-white focus:outline-none" @click="closeFormModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
                <div class="flex w-full mt-2">
                    <div class="w-1/2">
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Reporting For</label>
                                <select v-model="form.crime_id" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' required>
                                    <option v-show="checkType(crime)" v-for="crime in crimes" :value="crime.id">{{ crime.type }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >{{ form.crime_id == 6 ? 'Item Name' : 'Person Name'}}</label>
                                <input v-model="form.name" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Case Date</label>
                                <input v-model="form.crime_date" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='date'  required>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Reported By</label>
                                <input v-model="form.reported_by" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex">
                    <div class="w-1/2">
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Event Detail</label>
                                <textarea v-model="form.event_detail" style="resize: none;" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text' required></textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Action Taken</label>
                                <textarea v-model="form.action_taken" style="resize: none;" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text' required></textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Action Taken</label>
                                <textarea v-model="form.summary" style="resize: none;" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text' required></textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-2/4 px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Upload Image</label>
                                <input type="file" @change="imgChange" id="img" name="img" accept="image/*">
                            </div>
                            <div class='w-2/4 px-3 mb-1'>
                                <img width="30%" :src="img.url" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="flex items-center justify-between mt-2">
                            <div class='w-full px-3 mb-1'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Address</label>
                                <textarea v-model="form.address" style="resize: none;" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text' required></textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h1 class="text-gray-800 text-xl font-bold">Set Coodinates</h1>
                            <l-map @update:center="centerUpdate" style="height: 200px" :zoom="zoom" :center="center">
                            <l-tile-layer :url="url"></l-tile-layer>
                            <l-circle-marker
                                :lat-lng="circle.center"
                                :radius="circle.radius"
                                :color="circle.color"
                            />
                            </l-map>
                        </div>
                    </div>
                </div>
                <div class="personal w-full border-t border-gray-400 pt-4 my-auto">
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="saveReport()" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>{{isEdit ? 'Update' : 'Save'}} Report</span>
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
    import { latLng } from "leaflet";
    
    export default {
        data: () => ({
            isLoading: false,
            fullPage: true,
            viewMap: false,
            form: {
                id: 0,
                crime_id: 0,
                crime_date: new Date().getFullYear() + '-' + ('0' + (new Date().getMonth() + 1)).slice(-2) + '-' + ('0' + new Date().getDate()).slice(-2),
                name: '',
                event_detail:'',
                action_taken:'',
                summary:'',
                address:'',
                reported_by:''
            },
            coordinates: {
                lat:7.305887,
                lng:125.681082
            },
            imageFile: null,
            img: {
                url:'',
                thumb_url:'',
                uploader:'',
                extension:'',
                title:''
            },
            search: '',
            role: '',
            sortBy: '',
            isEdit: false,
            userInfo: {},
            rank_id: '',
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            zoom: 15,
            currentCenter: latLng(7.305887, 125.681082),
            center: [7.305887, 125.681082],
            circle: {
                center: [7.305887, 125.681082],
                radius: 10,
                color: 'red'
            },
            crimes: {}
        }),
        watch: {

        },
        computed: {
            ...mapGetters({
                ranks: 'rank/ranks',
                reports: 'report/reports',
                errors: 'report/errors',
                pagination: 'report/pagination'
            }),
        },
        methods: {
            checkType(crime) {
                if(crime.id == 4 || crime.id == 5 || crime.id == 6) {
                    return true
                } else {
                    return false
                }
            },
            centerUpdate(center) {
                this.currentCenter = center;
                this.coordinates.lat = center.lat;
                this.coordinates.lng = center.lng;
                this.circle.center = [center.lat, center.lng]
            },
            openFormModal() {
                this.isEdit = false;
                // this.clearForm();
                this.$modal.show('form')
            },
            closeFormModal() {
                this.$modal.hide('form')
            },
            async saveReport() {
                this.isLoading = true
                let formData = new FormData();
                formData.append('img', this.imageFile);
                formData.append('crime_id', this.form.crime_id);
                formData.append('crime_date', this.form.crime_date);
                formData.append('name', this.form.name);
                formData.append('event_detail', this.form.event_detail);
                formData.append('action_taken', this.form.action_taken);
                formData.append('summary', this.form.summary);
                formData.append('address', this.form.address);
                formData.append('reported_by', this.form.reported_by);
                formData.append('lat', this.coordinates.lat);
                formData.append('long', this.coordinates.lng);
                await this.$store.dispatch('report/saveReport', formData)
                if(Object.keys(this.errors).length == 0) {
                    this.closeFormModal();
                }
                this.isLoading = false
            },
            getCurrentLocation() {
                this.$getLocation({})
                    .then(coordinates => {
                        this.coordinates = coordinates
                    })
                    .catch(error => alert(error)) 
            },
            async getCrimesOptions() {
                const response = await axios.get('api/crime-type')
                this.crimes = response.data
            },
            imgChange(event) {
                console.log(event);
                this.imageFile = event.target.files[0]
                this.img.url = URL.createObjectURL(this.imageFile);
                this.img.file_type = event.target.files[0].type
            },
            async getReports(page = 1) {
                await this.$store.dispatch('report/getReports', {
                    params: {
                        page: page,
                        search: this.search,
                        role: this.role,
                        rank_id: this.rank_id
                    }
                })
            }
        },
        created() {
            this.getCrimesOptions()
            this.getReports()
        }
    }
</script>