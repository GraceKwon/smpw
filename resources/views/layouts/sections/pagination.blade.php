<div>
    <ul class="page">
       
        <li class="active"><a>1</a></li>
        <li><a>2</a></li>
        <li><a>3</a></li>
        <li><a>4</a></li>
        <li><a>5</a></li>
        <li><a>6</a></li>
    </ul>
</div>
{{-- 
<button type="button" 
        class="btn btn-secondary" 
        @click="setPage( firstPage )"
        v-if="currentGroup > 1">{{ firstPage }}</button>
        
<button type="button" 
        class="btn btn-secondary" 
        v-if="currentGroup > 1"
        disabled="true">...</button>

<button type="button" 
        class="btn btn-secondary" 
        :class="{active: n + firstPage == current_page}"
        v-for="n in loops"
        @click="setPage( n + firstPage )"
        :key="n">{{ n + firstPage }}</button>

<button type="button" 
        class="btn btn-secondary" 
        v-if="currentGroup < totGroup"
        disabled="true">...</button>
<button type="button" 
        class="btn btn-secondary" 
        @click="setPage( firstPage + maxBtn + 1 )"
        v-if="currentGroup < totGroup">{{ firstPage + maxBtn + 1 }}</button>
<script>
    export default {
        data() {
            return {
                maxBtn: 10
            }
        },
        props: [
            'current_page',
            'last_page',
        ],
        computed: {
            currentGroup: function () {
                return Math.ceil(this.current_page / this.maxBtn)
            },
            totGroup: function () {
                return Math.ceil(this.last_page / this.maxBtn)
            },
            firstPage: function () {
                return this.maxBtn * (this.currentGroup - 1)
            },
            loops: function () {
                // return this.totGroup >= this.currentGroup ? this.maxBtn : this.last_page % this.maxBtn
                return this.totGroup == this.currentGroup ? this.last_page - ( this.totGroup - 1 ) * this.maxBtn : this.maxBtn
            },
        },
        methods: {
            setPage: function (n) {
                this.$parent.$data.params.page = n
                this.$parent.$data.checkbox = []
                this.$emit('set-page')
            }
        },
    }
</script> --}}