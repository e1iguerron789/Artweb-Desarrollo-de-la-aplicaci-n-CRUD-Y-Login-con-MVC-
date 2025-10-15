<template>
    <div class="text-white">
        <h1>Lista de intereses del usuario</h1>
        <pre>{{ intereses }}</pre>
    </div>
</template>

<script setup>
defineProps({
    intereses: Array
});
</script>
