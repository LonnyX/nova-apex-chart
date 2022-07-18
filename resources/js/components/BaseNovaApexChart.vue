<template>
    <LoadingCard :loading="loading" class="px-6 py-4">
        <div class="h-6 flex items-center mb-4">
            <h3 v-if="title" class="mr-3 leading-tight text-sm font-bold">{{ title }}</h3>

            <HelpTextTooltip v-if="helpText" :text="helpText" :width="helpWidth" />

            <div class="ml-auto w-[16rem] flex-shrink-0">
                <litepie-datepicker :placeholder="datePlaceHolder || '-'" :formatter="dateFormatter" separator=" - " v-model="dateValue">
                </litepie-datepicker>
            </div>
        </div>

        <div class="mb-4" v-if="series">
            <apexchart :width="chartWidth" :height="chartHeight" :type="chartType" :options="options" :series="series">
            </apexchart>
        </div>
    </LoadingCard>
</template>

<style>
  @import '/index.css';
</style>

<script>
import VueApexCharts from "vue3-apexcharts";
import commaNumber from 'comma-number'
import LitepieDatepicker from 'litepie-datepicker';

export default {
    name: 'BaseNovaApexChart',

    components: {
        'apexchart': VueApexCharts,
        'litepie-datepicker': LitepieDatepicker
    },

    emits: ['selected'],

    data() {
        return {
            dateValue: {
                startDate: '',
                endDate: '',
            },
            dateFormatter: {
                date: 'YYYY-MM-DD',
                month: 'MM'
            }
        }
    },
    watch: {
        dateValue: function (val, oldVal) {
            this.handleChange(val);
        }
    },
    props: {
        chartWidth : '',
        chartHeight : '',
        chartType : '',
        datePlaceHolder : '',
        series : '',
        options : '',
        loading: { default: true },
        title: {},
        helpText: {},
        helpWidth: {},
        maxWidth: {},
    },

    methods: {
        handleChange(event) {
            let value = event?.target?.value || event

            this.$emit('selected', value)
        },
        handleFormatter(options) {
            Object.keys(options).forEach(key => {

                if (key === 'formatter') {
                    const prefix = options[key].prefix || ''
                    const suffix = options[key].suffix || ''
                    const showComma = options[key].showComma || false
                    options[key] = function (val) {
                        const finalValue = showComma ? commaNumber(val) : val
                        return `${prefix} ${finalValue} ${suffix}`
                    }
                }

                if (typeof options[key] === 'object') {
                    this.handleFormatter(options[key])
                }
            })

        }
    },

    computed: {
        options() {
            if (!this.options) {
                return;
            }
            const options = this.options
            this.handleFormatter(options)
            return options
        }
    },
}
</script>
