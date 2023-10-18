<script setup>
import { usePage, router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import {mdiChartTimelineVariantShimmer, mdiMenu, mdiAccountGroup} from "@mdi/js";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { computed } from 'vue';

const isMobile = computed(() => window.innerWidth <= 640);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const page = usePage();
const user = ref(page.props.auth.user);


const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
    <div class="bg-[#111827] w-full fixed top-0 z-10">
        <div class="flex justify-between items-center p-6">
            <div class="flex space-x-8 items-center">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white hover:text-gray-300">
                    Dashboard
                </NavLink>
                <Link :href="route('visualization')" class="flex items-center text-white hover:text-gray-300">
                    <v-icon size="x-large" class="mr-2">{{mdiChartTimelineVariantShimmer }}</v-icon>
                    <NavLink :href="route('visualization')" :active="route().current('visualization')" class="text-white hover:text-gray-300">
                        Data Visualization
                    </NavLink>
                </Link>
                <Link :href="route('peer-groups')" class="flex items-center text-white hover:text-gray-300">
                    <v-icon size="x-large" class="mr-2">{{mdiAccountGroup }}</v-icon>
                    <NavLink :href="route('peer-groups')" :active="route().current('peer-groups')" class="text-white hover:text-gray-300">
                        Peer Groups
                    </NavLink>
                </Link>
            </div>

            <div class="text-right flex space-x-4">
                <template v-if="isMobile">
                    <template v-if="user">
                        <!-- User is logged in -->
                        <Dropdown :align="'right'" :contentClasses="['py-1', 'bg-[#111827]']">
                            <template #trigger>
                                <button>
                                    <v-icon size="x-large" color="white">{{mdiMenu}}</v-icon>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.show')">Profile</DropdownLink>
                                <DropdownLink :href="route('about')">About Us</DropdownLink>
                                <form @submit.prevent="logout" >
                                    <ResponsiveNavLink as="button" type="submit" class="text-right">Log Out</ResponsiveNavLink>
                                </form>
                            </template>
                        </Dropdown>
                    </template>

                    <template v-else>
                        <!-- User is not logged in -->
                        <Dropdown :align="'right'" :contentClasses="['py-1', 'bg-[#111827]']">
                            <template #trigger>
                                <button>
                                    <v-icon size="x-large" color="white">{{mdiMenu}}</v-icon>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink as="a" :href="route('login')">Log in</DropdownLink>
                                <DropdownLink as="a" :href="route('register')">Register</DropdownLink>
                                <DropdownLink as="a" :href="route('about')">About Us</DropdownLink>
                            </template>
                        </Dropdown>
                    </template>
                </template>
                <template v-else>
                    <template v-if="user">
                        <NavLink @click.prevent="logout" :active="route().current('logout')" class="text-white hover:text-gray-300">
                            Log out
                        </NavLink>
                        <NavLink :href="route('profile.show')" :active="route().current('logout')" class="text-white hover:text-gray-300">
                            Profile
                        </NavLink>
                    </template>
                    <template v-else>
                        <NavLink :href="route('login')" :active="route().current('login')" class="text-white hover:text-gray-300">
                            Log in
                        </NavLink>
                        <NavLink :href="route('register')" :active="route().current('register')" class="text-white hover:text-gray-300">
                            Register
                        </NavLink>
                    </template>
                    <NavLink :href="route('about')" :active="route().current('about')" class="text-white hover:text-gray-300">
                        About Us
                    </NavLink>

                </template>
            </div>

        </div>
    </div>
</template>
