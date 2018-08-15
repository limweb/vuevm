// import Vue from 'vue'

// created() {
// this.$bus.$on('message', this.onReceive);
// }
// ---- in methods () ----------
// this.$bus.$emit('message', this.text);

const EventBus = new Vue({
    data() {
        return {};
    },
    computed: {
        scrwidth() {
            return screen.width;
        },
        scrheight() {
            return screen.height;
        },
        wdwidth() {
            return window.innerHeight;
        },
        wdheight() {
            return window.innerWidth;
        }
    },
    methods: {
        renderNumber(num) {
            if ((num == null) | isNaN(num)) {
                console.log("num is nul or nan =", num);
                return 0;
            } else {
                return Number(num).toLocaleString("th-TH", {
                    minimumFractionDigits: 2
                });
            }
        }
    }
});

EventBus.fontsize = function(multiplier) {
    if (document.body.style.fontSize == "") {
        document.body.style.fontSize = "1.0em";
    }
    document.body.style.fontSize =
        parseFloat(document.body.style.fontSize) + multiplier * 0.2 + "em";
    console.log(multiplier);
};

export default EventBus;