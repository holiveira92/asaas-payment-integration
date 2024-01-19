<template>
    <Layout>
        <!-- Title -->
        <Head title="Payments" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Novo Pagamento</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <div class="flex space-x-4">
                    <div class="bg-gray-700 p-4 rounded">
                        <input type="radio" v-model="option" name="credit_card" value="credit_card" required checked @change="onSelect"/>
                        <label for="credit_card" class="text-white cursor-pointer">Cartão de Crédito</label>
                    </div>
                    <div class="bg-gray-700 p-4 rounded">
                        <input type="radio" v-model="option" name="boleto" value="boleto" @change="onSelect" required/>
                        <label for="boleto" class="text-white cursor-pointer">Boleto</label>
                    </div>
                    <div class="bg-gray-700 p-4 rounded">
                        <input type="radio" v-model="option" name="pix" value="pix" @change="onSelect" required/>
                        <label for="pix" class="text-white cursor-pointer">Pix</label>
                    </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton @click="redirect"
                            class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Criar Pagamento
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>

<script>
import Layout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import Multiselect from '@vueform/multiselect';

export default {
    components: {
        Layout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
        Multiselect,
    },
    props: {

    },
    data() {
        return {
            option: "credit_card",
            form: useForm({
                optionSelected: ''
            }),
        };
    },
    methods: {

    onSelect(event) {
        this.option = event.target.value;
    },

    redirect(event) {
        window.location.href = route('payments.createBy', this.option)
    },

    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
