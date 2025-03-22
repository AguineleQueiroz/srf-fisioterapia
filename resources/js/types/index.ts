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
    city: string;
    created_at: string;
    updated_at: string;
    patient_name: string;
    cpf: string;
    birth_date: string;
    gender: string;
    phone: ?string;
    card_sus: string;
    address: string;
    primary_care_clinic: string;
    community_health_worker: string;
    diagnosis: ?string;
    comorbidity: ?string;
    last_hospitalization: string;
    registered_by: string;
    doctor_name: string;
    priority: string;
    registered: string;
    pain: number;
    pain_description: ?string;
    disability: number;
    disability_description: ?string;
    musculoskeletal: number;
    musculoskeletal_description: string;
    neurological: number;
    neurological_description: ?string;
    urogynaecological: number;
    urogynaecological_description: string;
    cardiovascular: number;
    cardiovascular_description: string;
    respiratory: number;
    respiratory_description: ?string;
    oncological: number;
    oncological_description: string;
    pediatric: number;
    pediatric_description: ?string;
    multiple_conditions: number;
    multiple_conditions_description: ?string;
    complaint: ?string;
    physical_exam_findings: string;
    standardized_tests: string;
    functional_condition: string;
    environmental_factors: ?string;
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
    criteria: ?string;
    justification: ?string;
    formatted_registered: string;
    formatted_cpf: string;
}
