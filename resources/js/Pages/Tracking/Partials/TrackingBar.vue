<script setup>

const props = defineProps({
    tasks: Object,
    activeTracking: Object,
})


</script>

<template>
    <v-row class="bg-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 my-lg-5" >
        <v-col cols = "4">
            <v-sheet>
                <v-text-field v-model="jobName" :model-value="jobName" label="Над чем работал?"></v-text-field>
            </v-sheet>
        </v-col>
        <v-col cols = "2">
            <v-sheet>
                <v-select
                    label="Задача"
                    v-model="taskId"
                    :item-title="'name'"
                    :item-value="'id'"
                    :items="tasks"
                ></v-select>
            </v-sheet>
        </v-col>
        <v-col cols = "2" class="my-3">
            <v-btn variant="tonal" v-bind:color="isTimerActive ? 'red' : 'green'" @click="clickToStartStopButton">
                {{ isTimerActive ? counter : 'Начать' }}
            </v-btn>
        </v-col>
    </v-row>
</template>

<script>
import {usePage} from "@inertiajs/vue3";

export default {
    data() {
        return {
            activeTracking: usePage().props.activeTracking,
            isTimerActive: this.activeTracking !== null,
            counter: '00:00:00',
            taskId: this.activeTracking?.task_id,
            jobName: this.activeTracking?.name,
            timer: this.activeTracking?.duration ?? 0,
        }
    },
    methods: {
        clickToStartStopButton() {
            this.jobName = this.jobName ?? 'Делаю новую задачу';

            let data = {
                name: this.jobName,
                task_id: this.taskId
            }

            if (!this.isTimerActive) {
                axios.post(route('api.tracking.start'), data)
                    .then(response => {
                        if (response.status === 200) {
                            this.switchButton();
                        }
                    }
                );
            } else {
                axios.post(route('api.tracking.stop'), data)
                    .then(response => {
                        if (response.status === 200) {
                            this.switchButton();
                            this.jobName = null;
                            this.$emit('freshTracking')
                        }
                    }
                );
            }
        },

        switchButton() {
            if (this.isTimerActive) {
                this.isTimerActive = false;
            } else {
                this.isTimerActive = true;
            }
        },
        convertSeconds(timeInsSeconds) {
            if (timeInsSeconds && timeInsSeconds > 0) {
                let minutesTemp = timeInsSeconds / 60;
                let seconds = timeInsSeconds % 60;
                let hours = Math.floor(minutesTemp / 60);
                let minutes = minutesTemp % 60;

                if (hours !== 0 && minutes !== 0) {
                    if (minutes >= 59) {
                        hours += 1;
                    } else {
                        minutes = minutes.toFixed(0)
                    }
                } else if (hours === 0 && minutes !== 0) {
                    minutes = minutes.toFixed(0);
                } else if (hours !== 0 && minutes === 0) {
                    return hours;
                }

                hours = this.formatNumber(hours)
                minutes = this.formatNumber(minutes)
                seconds = this.formatNumber(seconds)

                return `${hours}:${minutes}:${seconds}`;
            }
        },

        formatNumber(number) {
            return  number.toString().length === 1 ? `0${number}` : `${number}`;
        }
    },
    mounted() {
        setInterval(() => {
            if (this.isTimerActive) {
                this.timer++;
                this.counter = this.convertSeconds(this.timer);
            } else {
                this.timer = 0;
                this.counter = '00:00:00';
            }
        }, 1000)
    }
}
</script>
