# 🧠 Agent Instructions — A&G Consultores UI Refactor (Laravel + Tailwind)

## 🎯 Objective

Refactor the UI of an existing Laravel landing page to make it more modern, premium, and visually structured.

The site already uses:

* Laravel Blade
* TailwindCSS
* Custom Blade components (`x-hero-agc`, `x-course-card`)

The goal is to **enhance design quality without breaking functionality**.

---

## ⚙️ Hard Constraints (CRITICAL)

Do NOT modify:

* `route()` calls
* Blade variables (`$featuredCourses`, etc.)
* Blade directives (`@foreach`, `@include`, `@extends`)
* Component props (`x-hero-agc`, `x-course-card`)
* Form logic, CSRF, validation

Only modify:

* Tailwind classes
* Layout structure (divs, spacing)
* Visual hierarchy

---

## 🎨 Visual Direction

Target style:

* SaaS landing page (clean + premium)
* Soft shadows, rounded UI
* Subtle gradients (already used → keep and improve)
* More whitespace
* Better content grouping

---

## 🔧 Global Improvements

### 1. Section consistency

Replace inconsistent spacing with:

```html
<section class="py-16 md:py-24">
```

---

### 2. Container standardization

Replace:

```html
container mx-auto px-4
```

With:

```html
max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
```

---

### 3. Improve vertical rhythm

Add:

```html
space-y-6
space-y-8
```

Instead of manual margins everywhere.

---

## 🧩 Component-Level Rules

---

### 🟦 HERO (`x-hero-agc`)

Enhancements:

* Increase title impact
* Improve CTA spacing
* Add more breathing room

Suggested style:

```html
text-4xl md:text-6xl font-bold tracking-tight
```

CTA buttons:

```html
rounded-xl px-6 py-3 shadow-sm hover:shadow-md transition
```

---

### 🟪 IMAGE SECTION (flyer)

Current:

```html
<img class="object-contain">
```

Improve:

```html
<img class="rounded-2xl shadow-lg border border-slate-200">
```

Optional wrapper:

```html
<div class="bg-white p-4 rounded-3xl shadow-sm">
```

---

### 🟩 FEATURED COURSES

#### Grid improvement

Replace:

```html
w-[80%]
```

With:

```html
max-w-5xl mx-auto
```

---

#### Cards consistency

Ensure `x-course-card` follows:

```html
bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition
```

---

#### Section header

Improve hierarchy:

```html
<h2 class="text-3xl md:text-4xl font-bold tracking-tight">
```

---

### 🟨 CTA Button (Ver Todos los Cursos)

Replace current heavy classes with:

```html
class="inline-flex items-center gap-2 rounded-xl px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white shadow-sm hover:shadow-md transition"
```

---

## 📐 Layout Improvements

### Use grids properly:

```html
grid grid-cols-1 md:grid-cols-2 gap-8
```

Avoid:

* fixed widths (`w-[80%]`)
* manual centering hacks

---

## 📱 Responsive Rules

* Stack everything vertically on mobile
* Reduce font sizes proportionally
* Ensure buttons are full-width on mobile:

```html
w-full md:w-auto
```

---

## 🎯 Micro-UX Improvements

Add:

```html
transition-all duration-300
hover:-translate-y-1
```

For:

* cards
* buttons

---

## ✨ Visual Polish Rules

* Use **rounded-2xl everywhere**
* Keep shadows subtle (`shadow-sm`, `shadow-md`)
* Avoid harsh borders → use `border-slate-200`
* Use gradients only for:

  * titles
  * CTAs

---

## 🚀 Final Instruction

Refactor the landing page Blade file:

* Improve layout, spacing, and hierarchy
* Make the UI feel like a modern SaaS landing page
* Keep all existing logic intact
* Enhance visual consistency across all sections
* Do NOT introduce breaking changes

Focus on:

* Hero
* Sections
* Cards
* Grid layout
* CTA buttons

---
