<script setup>
import {onMounted, ref} from "vue";

// Vue.component('my-select', {
//     props: ['options'],
//     template: "#my-select"
// });

const props = defineProps({
    options: [Array, () => []],
    selected: Number
});

const options = ref({
    "1": "foo",
    "2": "bar",
    "3": "baz"
});
//
// new Vue({
//     el: "#app",
//     data: {
//         options: {
//             "1": "foo",
//             "2": "bar",
//             "3": "baz"
//         }
//     }
// });

</script>
<template>
    <select :value="selected" @change="$emit('update:selected', $event.target.value)">
        <option v-for="(text, value) in options" :value="value">
            {{ text }}
        </option>
    </select>
</template>
