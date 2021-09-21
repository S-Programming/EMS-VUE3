<template>
    <div id="app">
<!--        <div>-->
<!--            <TopBar></TopBar>-->
<!--            <SideBar></SideBar>-->
<!--        </div>-->
<!--        &lt;!&ndash;        <slot name="top-bar" />&ndash;&gt;-->

<!--        &lt;!&ndash;        <child></child>&ndash;&gt;-->
<!--        &lt;!&ndash;        <component v-bind:is="componentName"></component>&ndash;&gt;-->
<!--        &lt;!&ndash;        <slot name="main-content" />&ndash;&gt;-->
<!--        <UserList></UserList>-->
        <Login></Login>
    </div>
</template>


<script>
import Login from "../pages/auth/Login";
export default {
    name: "Default",
    components: {Login}
}
</script>

<style scoped>

</style>
