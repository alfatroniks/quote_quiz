<script setup>
import router from './router';

</script>

<template>
    <div id="app">
        <header>
            <nav>
                <router-link to="/">Start</router-link> |
                <router-link to="/mode">Mode</router-link>
            </nav>
        </header>
        <main>
            <router-view></router-view>
        </main>
        <footer>
            <p>© 2024 Qiuz</p>
        </footer>
    </div>
</template>

<style>
</style>
