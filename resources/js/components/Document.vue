<template>
    <div>
        <div class="flex flex-row-reverse mt-3">
            <button @click="print" class="focus:outline-none bg-blue-500 ml-auto fali-bg hover:bg-blue-300 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                <span>Print</span>
            </button>
        </div>
        <div class="bg-white mx-4 mt-5 pb-10" id="printMe">
            <div class="text-center mb-5">
                <p style="font-weight: bold; text-decoration: underline; font-size: 100px">POLICE REPORT</p>
            </div>
            <div style="display: flex; align-items: stretch;">
                <div style="width: 50%; margin-left: 30px">
                    <p><b style="font-weight: bold; font-size: 20px">Case No:</b> {{report.id}}</p><br>
                    <p><b style="font-weight: bold; font-size: 20px">Reporting Officer:</b> {{userInfo.last_name}}, {{userInfo.first_name}}</p><br>
                </div>
                <div style="width: 50%; margin-left: 30px">
                    <p><b style="font-weight: bold; font-size: 20px">Date:</b> {{report.crime_date}}</p><br>
                    <p><b style="font-weight: bold; font-size: 20px">Prepared By:</b> {{userInfo.last_name}}, {{userInfo.first_name}}</p><br>
                </div>
            </div>
            <div style="margin-left: 30px; margin-right: 30px">
                <p><b style="font-weight: bold; font-size: 20px">Incident:</b> {{report.crime.type}}</p><br>
            </div>
            <div style="margin-left: 30px; margin-right: 30px">
                <svg width="100%" height="30">
                    <rect width="100%" height="10" style="fill:rgb(0,0,0);stroke-width:3;stroke:rgb(0,0,0)" />
                    Sorry, your browser does not support inline SVG.  
                </svg>
            </div>
            <div style="margin-left: 30px; margin-top: 20px">
                <b style="font-weight: bold; font-size: 20px; text-decoration: underline ">Detail of Event:</b><br><br>
                <p>{{report.event_detail}}</p>
            </div>
            <div style="margin-left: 30px">
                <b style="font-weight: bold; font-size: 20px; text-decoration: underline">Actions Taken:</b><br><br>
                <p>{{report.action_taken}}</p>
            </div>
            <div style="margin-left: 30px; margin-bottom: 30px">
                <b style="font-weight: bold; font-size: 20px; text-decoration: underline">Summary:</b><br>
                <p>{{report.summary}}</p>
            </div>
            <div style="margin-left: 30px; margin-right: 30px">
                <svg width="100%" height="30">
                    <rect width="100%" height="10" style="fill:rgb(0,0,0);stroke-width:3;stroke:rgb(0,0,0)" />
                    Sorry, your browser does not support inline SVG.  
                </svg>
            </div>
            <div style="margin-left: 30px; margin-top: 30px">
                <b style="font-weight: bold; font-size: 20px; text-decoration: underline">Picture:</b><br>
                <img style="margin-left: auto; margin-right:auto" width="150px" :src="report.image_url" alt="">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            report: Object,
        },
        data () {
            return {
            output: null,
            userInfo: {}
            }
        },
        methods: {
            print () {
                this.$htmlToPaper('printMe');
            },
            async getInfo() {
                const response = await axios.get(`/user-detail`)
                this.userInfo = response.data.data;
                return
            },
        },
        created() {
            this.getInfo()
        }
    }
</script>