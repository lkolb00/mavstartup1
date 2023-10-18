import{T as m,r as d,o as c,d as u,b as a,u as o,w as r,F as p,Z as f,a as e,n as _,f as w,h as b}from"./app-9f7f684c.js";import{A as g}from"./AuthenticationCard-5ef52601.js";import{_ as h}from"./AuthenticationCardLogo-5406ab5c.js";import{_ as x,a as y}from"./TextInput-6005b1d9.js";import{_ as v}from"./InputLabel-4d208302.js";import{_ as V}from"./PrimaryButton-7b8b708f.js";import"./_plugin-vue_export-helper-c27b6911.js";const k=e("div",{class:"mb-4 text-sm text-gray-600 dark:text-gray-400"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),C=["onSubmit"],$={class:"flex justify-end mt-4"},q={__name:"ConfirmPassword",setup(A){const s=m({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(B,i)=>(c(),u(p,null,[a(o(f),{title:"Secure Area"}),a(g,null,{logo:r(()=>[a(h)]),default:r(()=>[k,e("form",{onSubmit:b(n,["prevent"])},[e("div",null,[a(v,{for:"password",value:"Password"}),a(x,{id:"password",ref_key:"passwordInput",ref:t,modelValue:o(s).password,"onUpdate:modelValue":i[0]||(i[0]=l=>o(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(y,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),e("div",$,[a(V,{class:_(["ml-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,C)]),_:1})],64))}};export{q as default};
