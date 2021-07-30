<template>
    <div>
       <div class="row">
           <div class="col-6">
                <label>Country</label>
                <v-select  v-model="selectedCountry" v-on:input="changeSelectedCountry" :options="countries" :reduce="country => country.code" label="country" />
           </div>
           <div class="col-6">
               <label>State</label>
               <v-select v-model="selectedState" v-on:input="changeSelectedState" :options="states" :reduce="state => state.code" label="state"></v-select>
           </div>
       </div>

        <div class="justify-content-center mt-3">
            <b-table show-empty bordered outlined noCollapse headVariant :items="phoneNumbers">
                <template #empty="scope">
                   <p class="text-center text-lg-center bold">There are no records to show</p>
                </template>
            </b-table>
        </div>

        <div class="row justify-content-center mt-4">
            <pagination :data="paginationMetaData" v-on:pagination-change-page="paginationClickCallback">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>
    </div>
</template>


<script>
    import vSelect from 'vue-select'
    import Paginate from 'laravel-vue-pagination'

    import PhoneNumberService from '../services/PhoneNumberService'
    import 'vue-select/dist/vue-select.css';


    Vue.component('v-select', vSelect)
    Vue.component('pagination', Paginate);

    export default {
        name: 'phone-number-component',
        data() {
            return {
                phoneNumbers: [],
                paginationMetaData: {},
                filters: {},
                selectedCountry: null,
                selectedState: null,
                page: 1,
                countries: [
                    {code: 237, country: 'Cameroon'},
                    {code: 251, country: 'Ethiopia'},
                    {code: 212, country: 'Morocco'},
                    {code: 258, country: 'Mozambique'},
                    {code: 256, country: 'Uganda'},
                ],
                states: [
                    {state: 'Valid phone numbers', code: 1},
                    {state: 'Not valid phone numbers', code: 0},
                ],

            };
        },
        methods: {
            retrievePhoneNumbers() {
                PhoneNumberService.getAll(this.filters)
                    .then(response => {
                        this.phoneNumbers = response.data.data;
                        this.paginationMetaData = response.data.meta;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            paginationClickCallback(pageNum) {
                this.page = pageNum
                this.filters = {
                    'country_code_filter': this.selectedCountry,
                    'state_filter': this.selectedState,
                    'page': pageNum,
                }
                this.retrievePhoneNumbers()
            },
            changeSelectedCountry() {
                this.filters = {
                    'country_code_filter': this.selectedCountry,
                    'state_filter': this.selectedState,
                }
                this.retrievePhoneNumbers()
            },
            changeSelectedState() {
                this.filters = {
                    'country_code_filter': this.selectedCountry,
                    'state_filter': this.selectedState,
                }
                this.retrievePhoneNumbers()
            },
        },
        mounted() {
            this.retrievePhoneNumbers();
        }
    }
</script>

<style scoped>

</style>
