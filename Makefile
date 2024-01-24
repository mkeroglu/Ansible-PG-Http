.PHONY: full-setup

full-setup:
    ansible-galaxy init /etc/ansible/roles/installer
    ansible-galaxy init /etc/ansible/roles/postgresql_setup
    rm -rf /etc/ansible/roles/installer/tasks/main.yml
    rm -rf /etc/ansible/roles/postgresql_setup/tasks/main.yml
    cp ./main-installer.yml /etc/ansible/roles/installer/tasks/main.yml
    cp ./main-setup.yml /etc/ansible/roles/postgresql_setup/tasks/main.yml
    ansible-playbook -i hosts.yaml pg-http-installer.yaml
    ansible-playbook -i hosts.yaml create-db-user-table.yaml
    ansible-playbook -i hosts.yaml into-to-table-with-csv.yaml
