# Fixes in custom themes

**Space between rows** (THEME HEADER)

```html
<style>
  .col-md-12 .col-md-3 {
      margin-bottom: 16px;
  }
</style>
```

**Challenges sorting** (CTFd/CTFd/utils/challenges/__init__.py)

```js
chal_q = (
        chal_q.filter_by(**query_args)
        .filter(*filters)
        .order_by(Challenges.category.desc(), Challenges.id.asc())
    )
```