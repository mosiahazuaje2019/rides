import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import PrimeVue from "primevue/config";
import mitt from "mitt";
import VueSweetalert2 from "vue-sweetalert2";

import "primevue/resources/themes/lara-light-indigo/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";

//import libraries
import AutoComplete from "primevue/autocomplete";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Column from "primevue/column";
import Dialog from "primevue/dialog";
import ToastService from "primevue/toastservice";
import Toast from "primevue/toast";
import Card from "primevue/card";
import Textarea from "primevue/textarea";
import Button from "primevue/button";
import Dropdown from "primevue/dropdown";
import Calendar from "primevue/calendar";
import RadioButton from "primevue/radiobutton";
import InputMask from "primevue/inputmask";
import Checkbox from "primevue/checkbox";
import Slider from "primevue/slider";
import ProgressSpinner from "primevue/progressspinner";
import FileUpload from "primevue/fileupload";
import Chip from "primevue/chip";
import MultiSelect from "primevue/multiselect";
import Avatar from "primevue/avatar";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faPlane,
    faUser,
    faUserTie,
    faUsers,
    faCar,
    faTaxi,
} from "@fortawesome/free-solid-svg-icons";

library.add(faPlane, faUser, faUserTie, faUsers, faCar, faTaxi);

const appName = import.meta.env.VITE_APP_NAME || "Laravel";
const emitter = mitt();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) });
        vueApp
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("AutoComplete", AutoComplete)
            .component("DataTable", DataTable)
            .component("InputText", InputText)
            .component("InputNumber", InputNumber)
            .component("Column", Column)
            .component("Dialog", Dialog)
            .component("Toast", Toast)
            .component("Card", Card)
            .component("Textarea", Textarea)
            .component("PrimeButton", Button)
            .component("Dropdown", Dropdown)
            .component("Calendar", Calendar)
            .component("RadioButton", RadioButton)
            .component("InputMask", InputMask)
            .component("Checkbox", Checkbox)
            .component("Slider", Slider)
            .component("ProgressSpinner", ProgressSpinner)
            .component("FileUpload", FileUpload)
            .component("Button", Button)
            .component("Chip", Chip)
            .component("MultiSelect", MultiSelect)
            .component("Avatar", Avatar)
            .use(PrimeVue)
            .use(ToastService)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueSweetalert2)
            .mixin({ methods: { route } });

        vueApp.config.globalProperties.emitter = emitter;
        vueApp.config.globalProperties.$route = route;
        vueApp.mount(el);

        return vueApp;
    },
    progress: {
        color: "#4B5563",
    },
});
