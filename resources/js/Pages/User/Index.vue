<template>
    <div class="flex justify-center items-center">
        <Table class="p-28 w-full"
               :users="users.data"
               :roles="roles"
        />

    </div>
</template>

<script setup>
import Table from "@/Components/Table.vue";
import {computed, ref} from "vue";

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
    roles: {
        type: Object,
        required: true
    }
});

const modalOpen = ref(true);
</script>

<style lang="scss" scoped>

</style>
