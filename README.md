```bash
git clone git@github.com:survos-sites/modo.git && cd modo
composer install
./c d:f:load -n
symfony server:start -d
symfony open:local
symfony open:local --path=/admin/browse/en

```
