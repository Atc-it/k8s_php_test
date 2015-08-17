#!/usr/bin/env bash

kubectl -s http://127.0.0.1:8080 delete -f app.service.yml
kubectl -s http://127.0.0.1:8080 delete -f app.rc.yml