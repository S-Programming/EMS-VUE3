<template>
    <div id="app">
<!--        <transition name="page" mode="out-in">-->
<!--            <component :is="defaultLayout" v-if="defaultLayout" />-->
<!--        </transition>-->
        <Login></Login>
    </div>
</template>

<script>
import Default from "./layouts/Default";
import Login from "./pages/auth/Login";
export default {
    name: "app",
    components: {
        Login,
        Default
    },
    data: () => ({
        defaultLayout: 'Default'
    }),
}
</script>
