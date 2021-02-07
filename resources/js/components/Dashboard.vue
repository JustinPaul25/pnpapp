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
        <div id="chart-container">
            <fusioncharts
            :type="type"
            :width="width"
            :height="height"
            :dataformat="dataFormat"
            :dataSource="dataSource"
            >
            </fusioncharts>
        </div>
    </div>
</template>

<script>
const chartData = [
    {
      label: "Venezuela",
      value: "290"
    },
    {
      label: "Saudi",
      value: "260"
    },
    {
      label: "Canada",
      value: "180"
    },
    {
      label: "Iran",
      value: "140"
    },
    {
      label: "Russia",
      value: "115"
    },
    {
      label: "UAE",
      value: "100"
    },
    {
      label: "US",
      value: "30"
    },
    {
      label: "China",
      value: "30"
    }
  ];

// STEP 3: Configure your chart
const dataSource = {
  chart: {
    caption: "Countries With Most Oil Reserves [2017-18]",
    subcaption: "In MMbbl = One Million barrels",
    xaxisname: "Country",
    yaxisname: "Reserves (MMbbl)",
    numbersuffix: "K",
    theme: "fusion"
  },
  data: chartData
  };

export default {
  name: 'app',
  data() {
    return {
      type: "bar2D",
      renderAt: "chart-container",
      width: "550",
      height: "350",
      dataFormat: "json",
      dataSource
    }
  }
}
</script>