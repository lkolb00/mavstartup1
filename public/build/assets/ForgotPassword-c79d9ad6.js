import{T as u,o as i,d as m,b as e,u as t,w as o,F as c,Z as f,t as _,e as p,a,n as w,f as g,h as x}from"./app-9f7f684c.js";import{A as y}from"./AuthenticationCard-5ef52601.js";import{_ as b}from"./AuthenticationCardLogo-5406ab5c.js";import{_ as h,a as k}from"./TextInput-6005b1d9.js";import{_ as V}from"./InputLabel-4d208302.js";import{_ as v}from"./PrimaryButton-7b8b708f.js";import"./_plugin-vue_export-helper-c27b6911.js";const F=a("div",{class:"mb-4 text-sm text-gray-600 dark:text-gray-400"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600 dark:text-green-400"},$=["onSubmit"],C={class:"flex items-center justify-end mt-4"},z={__name:"ForgotPassword",props:{status:String},setup(r){const s=u({email:""}),n=()=>{s.post(route("password.email"))};return(S,l)=>(i(),m(c,null,[e(t(f),{title:"Forgot Password"}),e(y,null,{logo:o(()=>[e(b)]),default:o(()=>[F,r.status?(i(),m("div",N,_(r.status),1)):p("",!0),a("form",{onSubmit:x(n,["prevent"])},[a("div",null,[e(V,{for:"email",value:"Email"}),e(h,{id:"email",modelValue:t(s).email,"onUpdate:modelValue":l[0]||(l[0]=d=>t(s).email=d),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(k,{class:"mt-2",message:t(s).errors.email},null,8,["message"])]),a("div",C,[e(v,{class:w({"opacity-25":t(s).processing}),disabled:t(s).processing},{default:o(()=>[g(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{z as default};
