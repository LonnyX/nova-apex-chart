<template>
    <BaseNovaApexChart
        @selected="handleSelected"
        :chartWidth="chartWidth"
        :chartHeight="chartHeight"
        :height="height"
        :width="width"
        :chartType="chartType"
        :series="series"
        :options="options"
        :title="name"
        :help-text="helpText"
        :help-width="helpWidth"
        :datePlaceHolder="datePlaceHolder"
        :disableDate="disableDate"
        :loading="loading" />
</template>

<script>
import { InteractsWithDates, MetricBehavior } from '@/mixins'
import Minimum from "@/util/minimum";
import BaseNovaApexChart from './BaseNovaApexChart.vue'

export default {
    name: "NovaApexChart",
    mixins: [InteractsWithDates, MetricBehavior],
    props: {
        card: {
            type: Object,
            required: true,
        },
        resourceName: {
            type: String,
            default: "",
        },
        resourceId: {
            type: [Number, String],
            default: "",
        },
        lens: {
            type: String,
            default: "",
        },
    },
    data: () => ({
        loading: true,
        data: [],
    }),
    watch: {
        resourceId() {
            this.fetch();
        },
    },
    created() {
        this.fetch();
    },
    mounted() {
        if (this.card && this.card.refreshWhenFiltersChange === true) {
            Nova.$on("filter-changed", this.fetch);
        }
    },
    beforeUnmount() {
        if (this.card && this.card.refreshWhenFiltersChange === true) {
            Nova.$off("filter-changed", this.fetch);
        }
    },
    methods: {
        handleSelected(dateValue) {
            this.selectedDateValue = {...dateValue};
            this.fetch();
        },
        fetch() {
            this.loading = true;
            Minimum(Nova.request().get(this.metricEndpoint, this.metricPayload())).then(
                ({
                    data: {
                        value: {
                            series,
                            type,
                            options,
                            chartHeight,
                            chartWidth,
                            width,
                            height,
                            datePlaceHolder,
                            disableDate,
                        },
                    },
                }) => {
                    this.series = series;
                    this.chartType = type;
                    this.options = options;
                    this.chartHeight = chartHeight;
                    this.chartWidth = chartWidth;
                    this.width = width;
                    this.height = height;
                    this.datePlaceHolder = datePlaceHolder;
                    this.disableDate = disableDate || false;
                    this.loading = false;
                }
            )
        },
        metricPayload() {
            const payload = {
                params: {
                    timezone: this.userTimezone,
                },
            };

            if (this.selectedDateValue) {
                payload.params.startDate = this.selectedDateValue.startDate
                payload.params.endDate = this.selectedDateValue.endDate
            }

            return payload;
        }
    },
    computed: {
        metricEndpoint() {
            const lens = this.lens !== "" ? `/lens/${this.lens}` : "";
            if (this.resourceName && this.resourceId) {
                return `/nova-api/${this.resourceNamae}${lens}/${this.resourceId}/metrics/${this.card.uriKey}`;
            }
            else if (this.resourceName) {
                return `/nova-api/${this.resourceName}${lens}/metrics/${this.card.uriKey}`;
            }
            else {
                return `/nova-api/metrics/${this.card.uriKey}`;
            }
        },
    },
    components: { BaseNovaApexChart }
}
</script>
