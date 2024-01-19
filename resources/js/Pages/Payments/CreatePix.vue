<template>
    <Layout>
        <!-- Title -->
        <Head title="Pagamento por Pix" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Pagamento por Pix</h2>
        </template>

        <div class="py-12">

            <form @submit.prevent="submit">
            <!-- <div class="max-w-xl mx-auto sm:px-6 lg:px-8"> -->
            <div class="max-w-xl sm:px-6 lg:px-8">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <!--  Dados do cliente -->
                    <label for="customer_name" class="block text-white w-full">Dados do Cliente</label>
                    <div class="mb-4">
                        <label for="customer_name" class="block text-white w-full">Nome</label>
                        <input type="text" id="customer_name" v-model="form.customer_name" class="form-input block w-full" required/>
                    </div>

                    <div class="mb-4">
                        <label for="customer_document" class="block text-white">CPF</label>
                        <input type="text" id="customer_document" v-model="form.customer_document" class="form-input"
                            placeholder="xxx.xxx.xxx-xx" required/>
                    </div>

                    <div class="mb-4 ">
                        <label for="customer_email" class="block text-white">Email</label>
                        <input type="text" id="customer_email" v-model="form.customer_email" class="form-input w-full" required/>
                    </div>

                    <div class="mb-4">
                        <label for="customer_phone" class="block text-white">Telefone</label>
                        <input type="text" id="customer_phone" v-model="form.customer_phone" class="form-input" required/>
                    </div>

                    <!--  Endereço -->
                    <label for="address_street" class="block text-white">Endereço</label>
                    <div class="mb-4 ">
                        <label for="address_street" class="block text-white">Rua</label>
                        <input type="text" id="address_street" v-model="form.address_street" class="form-input w-full" required/>
                    </div>

                    <div class="mb-4">
                        <label for="address_number" class="block text-white">Numero</label>
                        <input type="text" id="address_number" v-model="form.address_number" class="form-input" required/>
                    </div>

                    <div class="mb-4">
                        <label for="address_complement" class="block text-white">Complemento</label>
                        <input type="text" id="address_complement" v-model="form.address_complement" class="form-input" required/>
                    </div>

                    <div class="mb-4">
                        <label for="address_neighborhood" class="block text-white">Bairro</label>
                        <input type="text" id="address_neighborhood" v-model="form.address_neighborhood" class="form-input" required/>
                    </div>

                    <div class="mb-4">
                        <label for="address_city" class="block text-white">Cidade</label>
                        <input type="text" id="address_city" v-model="form.address_city" class="form-input" required/>
                    </div>

                    <div class="mb-4">
                        <label for="address_city" class="block text-white">Estado</label>
                        <input type="text" id="address_city" v-model="form.address_state" class="form-input" required/>
                    </div>

                    <div class="mb-4">
                        <label for="address_zip_code" class="block text-white">CEP</label>
                        <input type="text" id="address_zip_code" v-model="form.address_zip_code" class="form-input" required />
                    </div>

                </div>

                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-8">
                        <label for="card_number" class="block text-white">Dados para Pagamento</label>

                        <!-- VALOR -->
                        <div class="mb-4">
                            <label for="value" class="block text-white">Valor da Cobrança:</label>
                            <input type="number" id="value" v-model="form.value" class="form-input" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Finalizar Pagamento
                            </PrimaryButton>
                        </div>

                </div>
            </div>
            </form>

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
import moment from 'moment'


export default {
    components: {
        Layout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
        moment
    },
    props: {
        paymentMethod: Object,
        payments: Object,
    },
    data() {
        return {
            form: useForm({
                customer_name : this.payments.customer_name,
                customer_document : this.payments.customer_document,
                customer_email : this.payments.customer_email,
                customer_phone : this.payments.customer_phone,
                address_street : this.payments.address.address_street,
                address_number : this.payments.address.address_number,
                address_complement : this.payments.address.address_complement,
                address_neighborhood : this.payments.address.address_neighborhood,
                address_city : this.payments.address.address_city,
                address_state : this.payments.address.address_state,
                address_country : this.payments.address.address_country,
                address_zip_code : this.payments.address.address_zip_code,
                due_date: moment().format("YYYY-MM-DD"),
                value: 100,
                installments: 1,

            }),
        };
    },
    methods: {
        async submit() {
            await axios
                .post(route('api.payments.process'),
                {
                    "customer": {
                        "name": this.form.customer_name,
                        "email": this.form.customer_email,
                        "phone": this.form.customer_phone,
                        "document": this.form.customer_document,
                        "address": {
                            "street": this.form.address_street,
                            "number": this.form.address_number,
                            "complement": this.form.address_complement,
                            "neighborhood": this.form.address_neighborhood,
                            "zip_code": this.form.address_zip_code,
                            "city": this.form.address_city,
                            "state": this.form.address_state,
                            "country": "BR"
                        }
                    },
                    "payment": {
                        "amount": this.form.value,
                        "installments": this.form.installments,
                        "due_date": this.form.due_date,
                        "method_id": "89477f3d-1df4-4305-b79d-7857c2b37478",
                    }
                })
                .then(response => {
                    this.loading = true;
                    if (response?.partner_transaction_id === '') {
                        alert(response);
                        return false;
                    }

                    this.form.get(route("payments.thankYou", response.data.id), {
                        preserveScroll: true,
                        forceFormData: true,
                        onSuccess: () => this.form.reset(),
                        onError: () => {
                            if (this.form.errors.name) {
                                this.form.reset('name');
                            }
                        },
                    });
                })
                .catch(error => {
                    alert(error.response.data.message);
                    console.log(error);
                    this.errored = true
                })
                .finally(() => {
                })
        },
        onSelect(index, option) {
            this.form.installments = index;
        },
    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
