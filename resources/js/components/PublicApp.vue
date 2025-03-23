<template>
    <div class="app-container app-theme-dark" :class="{ 'closed-sidebar': !isCollapsed }">
        <main-header
            :isCollapsed="isCollapsed"
            :sidebarStatus="sidebarStatus"
            @changeSidebarStatus="sidebarVisualization"
            @openRightDrawer="openRightDrawer"
        />

        <div class="ui-theme-settings" :class="{ 'settings-open': isOpenRightSettings }">
            <button @click="openRightSettings()" type="button" id="TooltipDemo" class="btn-open-options btn" style="background-color: #ff4600">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x" style="color: black;"></i>
            </button>
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                </div>
            </div>
        </div>

        <div class="app-main">
            <main-sidebar :isCollapsed="isCollapsed" :sidebarStatus="sidebarStatus" @updateSidebar="toggleSidebar"></main-sidebar>

            <div class="app-main__outer">

                <div class="app-main__inner">
                    <router-view></router-view>
                </div>

                <main-footer></main-footer>
            </div>
        </div>

        <div class="app-drawer-wrapper" :class="{ 'drawer-open': isOpenRightDrawer }">
            <div class="drawer-nav-btn">
                <button type="button" @click="closeRightDrawer()" class="hamburger hamburger--elastic is-active">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
            <div class="drawer-content-wrapper">

            </div>
        </div>

        <div @click="closeRightDrawer()" class="app-drawer-overlay animated fadeIn" :class="{ 'd-none': !isOpenRightDrawer }"></div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isCollapsed: true,
            sidebarStatus: false,
            isOpenRightDrawer: false,
            isOpenRightSettings: false,
        };
    },
    methods: {
        sidebarVisualization() {
            this.isCollapsed = !this.isCollapsed;
        },
        toggleSidebar(status) {
            this.sidebarStatus = status;
        },
        openRightDrawer() {
            this.isOpenRightDrawer = true;
        },
        closeRightDrawer() {
            this.isOpenRightDrawer = false;
        },
        openRightSettings() {
            this.isOpenRightSettings = !this.isOpenRightSettings;
        },
    },
};
</script>

<style>
</style>
