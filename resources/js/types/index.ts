import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface MedicalForm {
    id: number;
    user_id: number;
    basic_medical_form_id: number;
    primary_medical_form_id: number;
    secondary_medical_form_id: number;
    referral: string;
    patient: {
        id: number;
        tenant_id: number;
        ulid: string;
        address: Array<{
            address: string;
            city: string;
        }>;
        patient_name: string;
        cpf: string;
        birth_date: string;
        gender: string;
        phone: string | null;
        card_sus: string;
        formatted_cpf: string;
        formatted_birthdate: string;
        formatted_gender: string;
        updated_at: string;
        created_at: string;
    };
    primary_care_clinic: string;
    community_health_worker: string;
    diagnosis: string | null;
    comorbidity: string | null;
    last_hospitalization: string;
    registered_by: string;
    doctor_name: string;
    priority: string;
    registered: string;
    pain: number;
    pain_description: string | null;
    disability: number;
    disability_description: string | null;
    musculoskeletal: number;
    musculoskeletal_description: string;
    neurological: number;
    neurological_description: string | null;
    urogynaecological: number;
    urogynaecological_description: string;
    cardiovascular: number;
    cardiovascular_description: string;
    respiratory: number;
    respiratory_description: string | null;
    oncological: number;
    oncological_description: string;
    pediatric: number;
    pediatric_description: string | null;
    multiple_conditions: number;
    multiple_conditions_description: string | null;
    complaint: string | null;
    physical_exam_findings: string;
    standardized_tests: string;
    functional_condition: string;
    environmental_factors: string | null;
    physiotherapeutic_diagnosis: string;
    move_se: number;
    menos_dor_mais_saude: number;
    peso_saudavel: number;
    geracao_esporte: number;
    none_alternatives: number;
    ra_move_se: number;
    ra_menos_dor_mais_saude: number;
    ra_peso_saudavel: number;
    ra_geracao_esporte: number;
    ra_none_alternatives: number;
    offered_treatment: string;
    functional_progress: string;
    sessions: string;
    attendance: string;
    personal_environmental_condition: string;
    criteria: string | null;
    justification: string | null;
    formatted_registered: string;
    tenant_id?: number;
    created_at: string;
    updated_at: string;
}

export interface FlashMessages {
    message: string,
    type: string
}
