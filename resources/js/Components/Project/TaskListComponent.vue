<script setup>
    import TaskComponent from "@/Components/Project/TaskComponent.vue";

    const headers = [
        { title: 'Что делал', key: 'name' },
        { title: 'Потратил времени', key: 'duration_time' },
        { title: 'Начал', key: 'started_at' },
        { title: 'Закончил', key: 'stopped_at' },
    ]
</script>
<template>
    <v-data-iterator class="w-100" :items="tasks" items-per-page="-1" slot="12">
        <template v-slot:default="{ items }">
            <template
                v-for="(item, i) in items"
                :key="i"
            >
                <task-component
                    :has-active-tracking="hasActiveTracking"
                    :task="item.raw"
                    @deletedTask="freshProjects"
                ></task-component>

            </template>
        </template>
    </v-data-iterator>
</template>

<script>
export default {
    props: {
        tasks: Object,
        hasActiveTracking: Boolean
    },
    methods: {
        freshProjects() {
            this.$emit('freshProjects');
        }
    }
}
</script>
