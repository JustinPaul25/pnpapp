<template>
    <div class="text-gray-200 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="mt-4">
            <h1 class="text-4xl text-yellow-500 font-bold">
                Crime Reports
            </h1>
        </div>
        <div class="p-4 flex justify-end items-center">
            <div class="flex items-center">
                <div class="relative text-gray-600 mr-4">
                    <input v-model="date" class="border border-orange-500 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="date" name="search" placeholder="Search">
                </div>
                <div class="relative text-gray-600 mr-4">
                    <input v-model="search" class="border border-orange-500 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search" name="search" placeholder="Search">
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                            width="512px" height="512px">
                            <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </div>
                    </button>
                </div>
                <div class="relative text-gray-600 mr-4">
                    <select v-model="crimeType" class="border border-orange-500 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search" name="search" placeholder="Search">
                        <option value="">All Crimes</option>
                        <option value="1">Focus Crimes</option>
                        <option value="2">Drug Related Incidents</option>
                        <option v-show="userInfo.role != 'Barangay Administrator'"  value="3">End Local Communist Armed Conflict (ELCAC)</option>
                        <option v-show="userInfo.role != 'Barangay Administrator'"  value="4">Missing persons</option>
                        <option v-show="userInfo.role != 'Barangay Administrator'"  value="5">Most wanted individuals</option>
                        <option v-show="userInfo.role != 'Barangay Administrator'"  value="6">Lost and found items</option>
                    </select>
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    </button>
                </div>
                <div v-show="userInfo.role != 'Barangay Administrator'" class="relative text-gray-600 mr-4">
                    <select v-model="status" class="border border-orange-500 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search" name="search" placeholder="Search">
                        <option value="">All Report Status</option>
                        <option value="1">Pending</option>
                        <option value="2">Discarded</option>
                        <option value="3">Approved</option>
                        <option value="4">Solved</option>
                    </select>
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    </button>
                </div>
                <button v-show="role != 'view_only'" @click="openFormModal" class="focus:outline-none ml-auto bg-yellow-500 hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
                    <span>Add Crime Report</span>
                </button>
            </div>
        </div>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b bg-gray-700">
                        <th class="text-left text-yellow-500 p-3 px-5">Date Reported</th>
                        <th class="text-left text-yellow-500 p-3 px-5">Reported Person/Item</th>
                        <th class="text-left text-yellow-500 p-3 px-5">Type</th>
                        <th class="text-left text-yellow-500 p-3 px-5">Photo</th>
                        <th class="text-left text-yellow-500 p-3 px-5">Status</th>
                        <th class="text-left text-yellow-500 p-3 px-5"></th>
                    </tr>
                    <tr v-for="report in reports.data" class="border-b hover:bg-yellow-200 bg-gray-100">
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b class="text-xs">{{ report.crime_date }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b class="uppercase text-xs">{{ report.name }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b class="text-xs">{{ report.crime.type }}</b>
                        </td>
                        <td class="w-8 p-3 px-5 text-gray-900 font-semibold">
                            <img width="100%" :src="report.image_url" alt="">
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b class="text-xs">{{ report.status.status }}</b>
                        </td>
                        <td class="p-3 px-5 flex justify-end">
                            <button v-show="showSolvedButton(report)" @click="reportSolved(report.id)" type="button" class="mr-3 text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                Mark as Solved
                            </button>
                            <button @click="openEditModal(report)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                View
                            </button>
                            <div v-show="report.status.status != 'Discard' && report.status.status != 'Solved'" class="flex">
                                <button  @click="approvedReport(report.id)" v-show="userInfo.role == 'Barangay Administrator'" type="button" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Approved
                                </button>
                                <button @click="discardReport(report.id)" type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Discard
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex px-3">
           <paginate
                :page-count="pagination.meta.last_page"
                :click-handler="getReports"
                :prev-text="`<i class='fas fa-angle-left'></i><b class='focus:outline-none'> Prev</b>`"
                :next-text="`<b class='focus:outline-none'>Next </b><i class='fas fa-angle-right'></i>`"
                :container-class="'pagination'"
                class="flex justify-end focus:outline-none ml-auto"
                prev-class="focus:outline-none text-sm mr-2 fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:shadow-outline" 
                next-class="focus:outline-none text-sm ml-2 fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:shadow-outline"  
                page-link-class="focus:outline-none text-sm mt-10 mx-2 hover:bg-yellow-500 text-bg-gray-800 py-1 px-2 rounded focus:shadow-outline" 
                active-class="focus:outline-none text-sm fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:shadow-outline"
                >
            </paginate>
        </div>
        <modal name="form" draggable=".window-header" :height="'auto'" :width="'80%'" :clickToClose="false">
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
                            <div class='w-full px-3 mb-1' v-show="form.crime_id == 1">
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >focus Crime Type</label>
                                <input v-model="form.focus_crime_type" class='appearance-none font-bold block w-full bg-white text-gray-700 border-gray-500 border shadow-inner rounded-md py-1 px-2 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
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
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Summary</label>
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
                        <button v-if="isEdit" @click="print()" class="focus:outline-none bg-blue-500 ml-auto fali-bg hover:bg-blue-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                            <span>Print</span>
                        </button>
                        <div>
                            <button v-if="!isLoading" @click="saveReport()" class="focus:outline-none bg-yellow-500 fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
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
            crimes: {},
            status: '',
            search: '',
            crimeType: '',
            date:'',
            userInfo: {},
        }),
        watch: {
            search: _.debounce(function(newVal){
                this.getReports(1)
            }, 200),
            status: _.debounce(function(newVal){
                this.getReports(1)
            }, 200),
            crimeType: _.debounce(function(newVal){
                this.getReports(1)
            }, 200),
            date: _.debounce(function(newVal){
                this.getReports(1)
            }, 200),
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
            showSolvedButton(report) {
                if(this.userInfo.role == 'Barangay Administrator' || report.status.id == 4 || report.status.id == 2) {
                    return false
                } else {
                    return true
                }
            },
            print() {
                window.open(`report-print/${this.form.id}`);
            },
            reportSolved(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Report will mark as Solved!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {
                        this.updateSolved(id)
                    }
                }) 
            },
            approvedReport(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Report will be Approved and send to Police Officer!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {
                        this.reportApproved(id)
                    }
                }) 
            },
            discardReport(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Report will be DISCARDED!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {
                        this.updateDiscard(id)
                    }
                }) 
            },
            async updateSolved(id) {
                this.isLoading = true
                await this.$store.dispatch('report/markSolved', { id: id });
                this.getReports(1);
                this.isLoading = false
            },
            async updateDiscard(id) {
                this.isLoading = true
                await this.$store.dispatch('report/markDiscard', { id: id });
                this.getReports(1);
                this.isLoading = false
            },
            async reportApproved(id) {
                this.isLoading = true
                await this.$store.dispatch('report/markApproved', { id: id });
                this.getReports(1);
                this.isLoading = false
            },
            checkType(crime) {
                if(crime.id == 4 || crime.id == 5 || crime.id == 6) {
                    if(this.userInfo.role != 'Barangay Administrator') {
                        return true
                    } else {
                        return false
                    }
                } else {
                    if(this.userInfo.role == 'Barangay Administrator') {
                        return true
                    } else  {
                        return false
                    }
                }
            },
            centerUpdate(center) {
                this.currentCenter = center;
                this.coordinates.lat = center.lat;
                this.coordinates.lng = center.lng;
                this.circle.center = [center.lat, center.lng]
            },
            openEditModal(report) {
                this.isEdit = true;
                this.center = [report.lat, report.long];
                this.coordinates = {
                    lat:report.lat,
                    lng:report.long
                }
                this.img.url = report.image_url
                this.$modal.show('form');
                this.form = {
                    id: report.id,
                    crime_id: report.crime.id,
                    focus_crime_type: report.focus_crimt_type,
                    crime_date: report.crime_date,
                    name: report.name,
                    event_detail: report.event_detail,
                    action_taken: report.action_taken,
                    summary: report.summary,
                    address: report.address,
                    reported_by:report.reported_by,
                }
            },
            openFormModal() {
                this.isEdit = false;
                this.clearForm();
                this.$modal.show('form')
            },
            clearForm() {
                this.form = {
                    id: 0,
                    crime_id: 0,
                    crime_date: new Date().getFullYear() + '-' + ('0' + (new Date().getMonth() + 1)).slice(-2) + '-' + ('0' + new Date().getDate()).slice(-2),
                    name: '',
                    event_detail:'',
                    action_taken:'',
                    summary:'',
                    address:'',
                    reported_by:''
                }
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
                if(this.isEdit) {
                    formData.append('id', this.form.id);
                    await this.$store.dispatch('report/updateReport', formData)
                    if(Object.keys(this.errors).length == 0) {
                        this.getReports(1)
                        this.closeFormModal();
                    }
                } else {
                    await this.$store.dispatch('report/saveReport', formData)
                    if(Object.keys(this.errors).length == 0) {
                        this.getReports(1)
                        this.closeFormModal();
                    }
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
                this.imageFile = event.target.files[0]
                this.img.url = URL.createObjectURL(this.imageFile);
                this.img.file_type = event.target.files[0].type
            },
            async getReports(page = 1) {
                await this.$store.dispatch('report/getReports', {
                    params: {
                        page: page,
                        search: this.search,
                        case_status_id: this.status,
                        crime_id: this.crimeType,
                        role: this.userInfo.role,
                        date: this.date
                    }
                })
            },
            async getInfo() {
                const response = await axios.get(`/user-detail`)
                this.userInfo = response.data.data;
                return
            },
            async createdMethods() {
                await this.getInfo();
                this.getReports()
            }
        },
        created() {
            this.createdMethods();
            this.getCrimesOptions();
        }
    }
</script>