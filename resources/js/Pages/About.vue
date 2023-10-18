<script setup>
import NavBar from "@/Components/NavBar.vue";
import { ref } from 'vue';

const name = ref('');
const phone = ref('');
const email = ref('');

const nameError = ref('');
const phoneError = ref('');
const emailError = ref('');

const validateName = () => {
    if (name.value.length < 2) {
        nameError.value = 'Name needs to be at least 2 characters.';
        return false;
    }
    nameError.value = '';
    return true;
};

const validatePhone = () => {
    const phonePattern = /^[0-9-]{10,}$/;
    if (!phonePattern.test(phone.value)) {
        phoneError.value = 'Phone number needs to be at least 10 digits.';
        return false;
    }
    phoneError.value = '';
    return true;
};

const validateEmail = () => {
    const emailPattern = /^[a-z.-]+@[a-z.-]+\.[a-z]+$/i;
    if (!emailPattern.test(email.value)) {
        emailError.value = 'Must be a valid e-mail.';
        return false;
    }
    emailError.value = '';
    return true;
};

const submit = () => {
    const isNameValid = validateName();
    const isPhoneValid = validatePhone();
    const isEmailValid = validateEmail();

    if (isNameValid && isPhoneValid && isEmailValid) {
        alert('Thank you for submitting the form');
    }
};

const clearForm = () => {
    name.value = '';
    phone.value = '';
    email.value = '';
    nameError.value = '';
    phoneError.value = '';
    emailError.value = '';
};
</script>

<template>
    <NavBar />
    <div class="accordian-container">
        <div class="text-center d-flex pb-4">
            <v-btn class="ma-2" @click="all">
                Expand All
            </v-btn>
            <v-btn class="ma-2" @click="none">
                Collapse All
            </v-btn>
        </div>

        <v-expansion-panels
            v-model="panel"
            multiple
        >
            <v-expansion-panel
                title="Contact Us"
                value="foo"
            >
                <v-expansion-panel-text class="address-container">
                    Office of Institutional Effectiveness.<br>
                    6001 Dodge St.Omaha.NE 68182.<br>
                    Office of Institutional Effectiveness.<br>
                    EAB 202<br>
                    +1402-554-2289<br>
                </v-expansion-panel-text>
            </v-expansion-panel>

            <v-expansion-panel
                title="Email Us"
                value="bar"
            >
                <v-expansion-panel-text>
                    <form @submit.prevent="submit">
                        <v-text-field
                            v-model="name"
                            :error-messages="nameError"
                            label="Name"
                            @blur="validateName"
                        ></v-text-field>

                        <v-text-field
                            v-model="phone"
                            :error-messages="phoneError"
                            label="Phone Number"
                            @blur="validatePhone"
                        ></v-text-field>

                        <v-text-field
                            v-model="email"
                            :error-messages="emailError"
                            label="E-mail"
                            @blur="validateEmail"
                        ></v-text-field>

                        <v-btn @click="submit">
                            Submit
                        </v-btn>

                        <v-btn @click="clearForm">
                            Clear
                        </v-btn>
                    </form>
                </v-expansion-panel-text>
            </v-expansion-panel>

            <v-expansion-panel
                title="Find Us"
                value="baz"
            >
                <v-expansion-panel-text>
                    <iframe
                        class="google-map"
                        frameborder="0"
                        style="border:0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2999.335483221361!2d-96.0132709235035!3d41.25803080400829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87938dbbc0f89afb%3A0x4dbea6a55857784f!2sUniversity%20of%20Nebraska%20Omaha!5e0!3m2!1sen!2sus!4v1696434877553!5m2!1sen!2sus"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    />
                </v-expansion-panel-text>
            </v-expansion-panel>
        </v-expansion-panels>
    </div>
</template>
<script>
export default {
    data () {
        return {
            panel: [],
        }
    },
    methods: {
        all () {
            this.panel = ['foo', 'bar', 'baz']
        },
        none () {
            this.panel = []
        },
    },
}
</script>

<style>
.accordian-container{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10%;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
}

.address-container{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.google-map {
    width: 100%;
    height: 450px; /* Adjust the height as needed */
    margin-top: 10px;
}
</style>
