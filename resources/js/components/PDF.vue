<template>
   <div class="bg-white">
       <button @click="generateReport()">asdasd</button>
     <vue-html2pdf
        :show-layout="false"
        :float-layout="true"
        :enable-download="true"
        :preview-modal="true"
        :paginate-elements-by-height="1400"
        :filename="report.name"
        :pdf-quality="2"
        :manual-pagination="false"
        pdf-format="a4"
        pdf-orientation="landscape"
        pdf-content-width="100%"

        @progress="onProgress($event)"
        @hasStartedGeneration="hasStartedGeneration()"
        @hasGenerated="hasGenerated($event)"
        ref="html2Pdf"
    >
        <section slot="pdf-content">
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
        </section>
    </vue-html2pdf>
   </div>
</template>

<script>
import VueHtml2pdf from 'vue-html2pdf'

export default {
    props: {
        report: Object,
    },
    data () {
        return {
            userInfo: {}
        }
    },
    methods: {
        generateReport () {
            this.$refs.html2Pdf.generatePdf()
        },
        async getInfo() {
            const response = await axios.get(`/user-detail`)
            this.userInfo = response.data.data;
            return
        },
    },

    components: {
        VueHtml2pdf
    },
    created() {
        this.getInfo()
    }
}
</script>
