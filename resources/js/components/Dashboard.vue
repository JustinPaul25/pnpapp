<template>
    <div class="text-gray-200 vld-parent">
        <!-- <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading> -->
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl text-yellow-500 font-bold">
                    Dashboard
                </h1>
            </div>
        </div>
        <div class="w-full flex px-2">
          <div class="w-1/4 px-2">
            <div class="flex w-full">
              <div class="w-3/5 bg-gray-300 rounded-l-md">
                <p class="text-xl font-bold text-yellow-500 mt-2 ml-2">
                  Pending
                </p>
                <p class="text-3xl text-right font-bold text-gray-900 mr-4">
                  {{ byStatus.pending }} Cases
                </p>
              </div>
              <div class="w-2/5 bg-yellow-500">
                <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mx-auto my-4"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
              </div>
            </div>  
          </div>
          <div class="w-1/4 px-2">
            <div class="flex w-full">
              <div class="w-3/5 bg-gray-300 rounded-l-md">
                <p class="text-xl font-bold text-green-500 mt-2 ml-2">
                  Approved
                </p>
                <p class="text-3xl text-right font-bold text-gray-900 mr-4">
                  {{ byStatus.approved }} Cases
                </p>
              </div>
              <div class="w-2/5 bg-green-500">
                <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mx-auto my-4"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
              </div>
            </div>  
          </div>
          <div class="w-1/4 px-2">
            <div class="flex w-full">
              <div class="w-3/5 bg-gray-300 rounded-l-md">
                <p class="text-xl font-bold text-blue-500 mt-2 ml-2">
                  Solved
                </p>
                <p class="text-3xl text-right font-bold text-gray-900 mr-4">
                  {{ byStatus.solved }} Cases
                </p>
              </div>
              <div class="w-2/5 bg-blue-500">
                <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mx-auto my-4"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
              </div>
            </div>  
          </div>
          <div class="w-1/4 px-2">
            <div class="flex w-full">
              <div class="w-3/5 bg-gray-300 rounded-l-md">
                <p class="text-xl font-bold text-red-500 mt-2 ml-2">
                  Discard
                </p>
                <p class="text-3xl text-right font-bold text-gray-900 mr-4">
                  {{ byStatus.discard }} Cases
                </p>
              </div>
              <div class="w-2/5 bg-red-500">
                <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mx-auto my-4"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
              </div>
            </div>  
          </div>
        </div>
        <div class="w-full flex mt-4">
          <div class="w-1/2 px-4">
            <fusioncharts
            :type="solved.type"
            :width="solved.width"
            :height="solved.height"
            :dataFormat="solved.dataFormat"
            :dataSource="solved.dataSource"
            ></fusioncharts>
          </div>
          <div class="w-1/2 px-4">
            <fusioncharts
            :type="approved.type"
            :width="approved.width"
            :height="approved.height"
            :dataFormat="approved.dataFormat"
            :dataSource="approved.dataSource"
            ></fusioncharts>
          </div>
        </div>
        <div class="w-full flex mt-4">
          <div class="w-1/2 px-4">
            <fusioncharts
            :type="pending.type"
            :width="pending.width"
            :height="pending.height"
            :dataFormat="pending.dataFormat"
            :dataSource="pending.dataSource"
            ></fusioncharts>
          </div>
          <div class="w-1/2 px-4">
            <fusioncharts
            :type="discard.type"
            :width="discard.width"
            :height="discard.height"
            :dataFormat="discard.dataFormat"
            :dataSource="discard.dataSource"
            ></fusioncharts>
          </div>
        </div>
        <div class="w-full flex">
          <div class="w-1/3 px-2">

          </div>
          <div class="w-1/3 px-2">

          </div>
          <div class="w-1/3 px-2">

          </div>
        </div>
    </div>
</template>

<script>
    
export default {
  name: 'app',
  data() {
    return {
      form: {
          lines: [
          ],
          monthlines: [

          ]
      },
      discard: {
        type: 'column2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource: {
          // Chart Configuration
          "chart": {
              "caption": "Discard Case Within this Year",
              "xAxisName": "Month",
              "yAxisName": "Reports",
              "numberSuffix": "",
              "theme": "fusion",
              "formatNumber": "0"
          },
          // Chart Data
          data: []
        }
      },
      pending: {
        type: 'column2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource: {
          // Chart Configuration
          "chart": {
              "caption": "Pending Case Within this Year",
              "xAxisName": "Month",
              "yAxisName": "Reports",
              "numberSuffix": "",
              "theme": "fusion",
              "formatNumber": "0"
          },
          // Chart Data
          data: []
        }
      },
      solved: {
        type: 'column2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource: {
          // Chart Configuration
          "chart": {
              "caption": "Solved Case Within this Year",
              "xAxisName": "Month",
              "yAxisName": "Reports",
              "numberSuffix": "",
              "theme": "fusion",
              "formatNumber": "0"
          },
          // Chart Data
          data: []
        }
      },
      approved: {
        type: 'column2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource: {
          // Chart Configuration
          "chart": {
              "caption": "Approved Case Within this Year",
              "xAxisName": "Month",
              "yAxisName": "Reports",
              "numberSuffix": "",
              "theme": "fusion",
              "formatNumber": "0"
          },
          // Chart Data
          data: []
        }
      },
      byStatus: {
        pending: 0,
        approved: 0,
        discard: 0,
        solved: 0
      }
    }
  },
  methods: {
    async getDatas() {
        const response = await axios.get(`/get-all-reports`)
        for(var ctr = 0; ctr < response.data.data.length; ctr++) {
          var date = new Date( response.data.data[ctr].crime_date )
          var month = date.getMonth()
          if(response.data.data[ctr].status.id == 1) {
            this.byStatus.pending = this.byStatus.pending + 1
          }
          if(response.data.data[ctr].status.id == 2) {
            this.byStatus.discard = this.byStatus.discard + 1
          }
          if(response.data.data[ctr].status.id == 3) {
            this.byStatus.approved = this.byStatus.approved + 1
          }
          if(response.data.data[ctr].status.id == 4) {
            this.byStatus.solved = this.byStatus.solved + 1
          }
        }
    },
    async getApprovedReports () {
      let dummyData = 0;
      var monthlines = [];

        await axios.get('/get-approved')
            .then((data)  => {
                var monthlys = data.data;

                monthlines.push({
                    label: 'Jan',
                    value: !monthlys.Jan ? "0" : monthlys.Jan.length,
                })

                monthlines.push({
                    label: 'Feb',
                    value: !monthlys.Feb ? "0" : monthlys.Feb.length,
                })

                monthlines.push({
                    label: 'Mar',
                    value: !monthlys.Mar ? "0" : monthlys.Mar.length,
                })

                monthlines.push({
                    label: 'Apr',
                    value: !monthlys.Apr ? "0" : monthlys.Apr.length,
                })

                monthlines.push({
                    label: 'May',
                    value: !monthlys.May ? "0" : monthlys.May.length,
                })

                monthlines.push({
                    label: 'Jun',
                    value: !monthlys.Jun ? "0" : monthlys.Jun.length,
                })

                monthlines.push({
                    label: 'Jul',
                    value: !monthlys.Jul ? "0" : monthlys.Jul.length,
                })

                monthlines.push({
                    label: 'Aug',
                    value: !monthlys.Aug ? "0" : monthlys.Aug.length,
                })

                monthlines.push({
                    label: 'Sep',
                    value: !monthlys.Sep ? "0" : monthlys.Sep.length,
                })

                monthlines.push({
                    label: 'Oct',
                    value: !monthlys.Oct ? "0" : monthlys.Oct.length,
                })

                monthlines.push({
                    label: 'Nov',
                    value: !monthlys.Nov ? "0" : monthlys.Nov.length,
                })

                monthlines.push({
                    label: 'Dec',
                    value: !monthlys.Dec ? "0" : monthlys.Dec.length,
                })

                });
            
            this.approved.dataSource.data = monthlines;
    },
    async getSolvedReports () {
       let dummyData = 0;
       let monthlines = []

        await axios.get('/get-solved')
            .then((data)  => {
                this.monthlys = data.data;

                monthlines.push({
                    label: 'Jan',
                    value: !this.monthlys.Jan ? "0" : this.monthlys.Jan.length,
                })

                monthlines.push({
                    label: 'Feb',
                    value: !this.monthlys.Feb ? "0" : this.monthlys.Feb.length,
                })

                monthlines.push({
                    label: 'Mar',
                    value: !this.monthlys.Mar ? "0" : this.monthlys.Mar.length,
                })

                monthlines.push({
                    label: 'Apr',
                    value: !this.monthlys.Apr ? "0" : this.monthlys.Apr.length,
                })

                monthlines.push({
                    label: 'May',
                    value: !this.monthlys.May ? "0" : this.monthlys.May.length,
                })

                monthlines.push({
                    label: 'Jun',
                    value: !this.monthlys.Jun ? "0" : this.monthlys.Jun.length,
                })

                monthlines.push({
                    label: 'Jul',
                    value: !this.monthlys.Jul ? "0" : this.monthlys.Jul.length,
                })

                monthlines.push({
                    label: 'Aug',
                    value: !this.monthlys.Aug ? "0" : this.monthlys.Aug.length,
                })

                monthlines.push({
                    label: 'Sep',
                    value: !this.monthlys.Sep ? "0" : this.monthlys.Sep.length,
                })

                monthlines.push({
                    label: 'Oct',
                    value: !this.monthlys.Oct ? "0" : this.monthlys.Oct.length,
                })

                monthlines.push({
                    label: 'Nov',
                    value: !this.monthlys.Nov ? "0" : this.monthlys.Nov.length,
                })

                monthlines.push({
                    label: 'Dec',
                    value: !this.monthlys.Dec ? "0" : this.monthlys.Dec.length,
                })

                });
            
            this.solved.dataSource.data = monthlines;
    },
    async getDiscardReports () {
      let dummyData = 0;
      var monthlines = [];

        await axios.get('/get-discard')
            .then((data)  => {
                var monthlys = data.data;

                monthlines.push({
                    label: 'Jan',
                    value: !monthlys.Jan ? "0" : monthlys.Jan.length,
                })

                monthlines.push({
                    label: 'Feb',
                    value: !monthlys.Feb ? "0" : monthlys.Feb.length,
                })

                monthlines.push({
                    label: 'Mar',
                    value: !monthlys.Mar ? "0" : monthlys.Mar.length,
                })

                monthlines.push({
                    label: 'Apr',
                    value: !monthlys.Apr ? "0" : monthlys.Apr.length,
                })

                monthlines.push({
                    label: 'May',
                    value: !monthlys.May ? "0" : monthlys.May.length,
                })

                monthlines.push({
                    label: 'Jun',
                    value: !monthlys.Jun ? "0" : monthlys.Jun.length,
                })

                monthlines.push({
                    label: 'Jul',
                    value: !monthlys.Jul ? "0" : monthlys.Jul.length,
                })

                monthlines.push({
                    label: 'Aug',
                    value: !monthlys.Aug ? "0" : monthlys.Aug.length,
                })

                monthlines.push({
                    label: 'Sep',
                    value: !monthlys.Sep ? "0" : monthlys.Sep.length,
                })

                monthlines.push({
                    label: 'Oct',
                    value: !monthlys.Oct ? "0" : monthlys.Oct.length,
                })

                monthlines.push({
                    label: 'Nov',
                    value: !monthlys.Nov ? "0" : monthlys.Nov.length,
                })

                monthlines.push({
                    label: 'Dec',
                    value: !monthlys.Dec ? "0" : monthlys.Dec.length,
                })

                });
            
            this.discard.dataSource.data = monthlines;
    },
    async getPendingReports () {
      let dummyData = 0;
      var monthlines = [];

        await axios.get('/get-pending')
            .then((data)  => {
                var monthlys = data.data;

                monthlines.push({
                    label: 'Jan',
                    value: !monthlys.Jan ? "0" : monthlys.Jan.length,
                })

                monthlines.push({
                    label: 'Feb',
                    value: !monthlys.Feb ? "0" : monthlys.Feb.length,
                })

                monthlines.push({
                    label: 'Mar',
                    value: !monthlys.Mar ? "0" : monthlys.Mar.length,
                })

                monthlines.push({
                    label: 'Apr',
                    value: !monthlys.Apr ? "0" : monthlys.Apr.length,
                })

                monthlines.push({
                    label: 'May',
                    value: !monthlys.May ? "0" : monthlys.May.length,
                })

                monthlines.push({
                    label: 'Jun',
                    value: !monthlys.Jun ? "0" : monthlys.Jun.length,
                })

                monthlines.push({
                    label: 'Jul',
                    value: !monthlys.Jul ? "0" : monthlys.Jul.length,
                })

                monthlines.push({
                    label: 'Aug',
                    value: !monthlys.Aug ? "0" : monthlys.Aug.length,
                })

                monthlines.push({
                    label: 'Sep',
                    value: !monthlys.Sep ? "0" : monthlys.Sep.length,
                })

                monthlines.push({
                    label: 'Oct',
                    value: !monthlys.Oct ? "0" : monthlys.Oct.length,
                })

                monthlines.push({
                    label: 'Nov',
                    value: !monthlys.Nov ? "0" : monthlys.Nov.length,
                })

                monthlines.push({
                    label: 'Dec',
                    value: !monthlys.Dec ? "0" : monthlys.Dec.length,
                })

                });
            
            this.pending.dataSource.data = monthlines;
    },
  },
  created() {
    this.getDatas()
    this.getSolvedReports()
    this.getApprovedReports()
    this.getDiscardReports()
    this.getPendingReports()
  }
}
</script>