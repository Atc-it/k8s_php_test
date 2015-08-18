#!/usr/bin/env bash

kubectl -s http://127.0.0.1:8080 rolling-update --update-period="15s" k8s-php-test --image=bitgandtter/k8s_php_test:latest