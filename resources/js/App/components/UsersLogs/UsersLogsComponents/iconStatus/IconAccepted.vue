<template>
    <b-avatar
        size="56px"
        badge
        :class="statusUser"
        :src="url_avatar"
    >
        <template #badge>
            <b-icon icon="check" scale="1.3" aria-hidden="true"></b-icon>
        </template>
    </b-avatar>
</template>

<script>
export default {
    name: "AcceptedAvatar",
    props:[
        'statusUser',
        'url_avatar',
    ],
}
</script>

<style scoped>

</style>
