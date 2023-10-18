<script setup>
import NavBar from "@/Components/NavBar.vue";


</script>


<template>
    <NavBar />
    <div class="tooltip-container">
        <v-tooltip text="Peer Groups Table"  >
            <template v-slot:activator="{ props }">
                <v-btn v-bind="props" id="custom-tooltip">
                    <v-icon size="x-large" class="mr-2">{{mdiAccountGroup }}</v-icon>
                    Peer Groups
                </v-btn>
            </template>
        </v-tooltip>
    </div>

    <PeerGroupTable />


</template>

<style scoped>
.tooltip-container {
    position: absolute;
    top: 120px; /* Adjust based on your navbar's height */
    left: 50%;
    transform: translateX(-50%);
}



#custom-tooltip {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #111827;
    width: 900px;
    height: 50px;
    font-size: 1.2rem; /* Adjust for bigger font */
    font-weight: 700; /* Heavier font */
    color: white;
}
</style>
