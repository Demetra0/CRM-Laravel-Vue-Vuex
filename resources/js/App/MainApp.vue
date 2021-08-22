<template>
    <div class="main">
        <Header />
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

import Header from './components/Header/Header';

export default {
    name: 'main-App',
    components: {
        Header,
    }
}
</script>
