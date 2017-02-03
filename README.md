# TMG Consulting
TMG has one repo setup on the live server that serves both development and production
environments.

```
ssh://tmgconsulting@104.131.38.53/home/tmgconsulting/repos/tmgconsulting.git
```

To push to dev.tmgconsulting.com:
```
git push {remote-name} develop:develop
```

To push to production:
```
git push {remote-name} master:master
```
