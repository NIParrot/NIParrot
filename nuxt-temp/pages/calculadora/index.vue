<template>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Calculadora</h5> <small>define as métricas básicas da calculadora</small>
                </div>
                <div class="ibox-content">
                    <div class="form-group row align-midle">
                        <div class="col-md-6" />
                        <div class="col-md-1 text-center"><small>Muito Simples</small></div>
                        <div class="col-md-1 text-center"><small>Simples</small></div>
                        <div class="col-md-1 text-center"><small>Médio</small></div>
                        <div class="col-md-1 text-center"><small>Difícil</small></div>
                        <div class="col-md-1 text-center"><small>Muito Difícil</small></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label">{{padrao.nome}}</label>
                        <div class="col-md-1"><input type="text" class="form-control text-center" v-model="padrao.muitoSimples" /></div>
                        <div class="col-md-1"><input type="text" class="form-control text-center" v-model="padrao.simples" /></div>
                        <div class="col-md-1 text-center"><label class="col-form-label">{{padrao.medio}}</label></div>
                        <div class="col-md-1"><input type="text" class="form-control text-center" v-model="padrao.dificil" /></div>
                        <div class="col-md-1"><input type="text" class="form-control text-center" v-model="padrao.muitoDificil" /></div>
                    </div>
                    <div class="hr-line-dashed"/>
                    <div class="form-group row" v-for="tec in tecnologias" v-bind:key="tec.id" >
                        <div class="col-md-6"><input type="text" class="form-control" v-model="tec.nome"></div>
                        <div class="col-md-1 text-center"><label class="col-form-label">{{tec.muitoSimples}}</label></div>
                        <div class="col-md-1 text-center"><label class="col-form-label">{{tec.simples}}</label></div>
                        <div class="col-md-1"><input type="text" class="form-control text-center" v-model="tec.medio" v-bind:change="calculateTec(tec)"></div>
                        <div class="col-md-1 text-center"><label class="col-form-label">{{tec.dificil}}</label></div>
                        <div class="col-md-1 text-center"><label class="col-form-label">{{tec.muitoDificil}}</label></div>
                        <button class="btn btn-danger btn-xs" v-on:click="deleteTec(tec)">Excluir</button>
                    </div>
                    <div class="text-right"><button class="btn btn-primary" v-on:click="createNewTec()">Nova Tecnologia</button></div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>

const uuidv1 = require("uuid/v1");

export default {
    data(){
        return {
            padrao : {
                nome: "Tecnologias",
                muitoSimples: 20,
                simples: 40,
                medio: "",
                dificil: 150,
                muitoDificil: 200
            },
            tecnologias: [
            ]
        }
    },
    methods:{
        createNewTec: function(){
            this.tecnologias.push({
               id: uuidv1(),
               nome: "Nova Tecnologia",
               muitoSimples: 0,
               simples: 0,
               medio: 0,
               dificil: 0,
               muitoDificil: 0
            });
        },
        deleteTec: function(tec){
            if (tec)
                this.tecnologias.pop(tec);
        },
        calculateTec: function(tec){
            if (tec)
            {
                tec.muitoSimples = Math.round(tec.medio * (this.padrao.muitoSimples / 100));
                tec.simples = Math.round(tec.medio * (this.padrao.simples / 100));
                tec.dificil = Math.round(tec.medio * (this.padrao.dificil / 100));
                tec.muitoDificil = Math.round(tec.medio * (this.padrao.muitoDificil / 100));
            }
        }
    }
}
</script>

